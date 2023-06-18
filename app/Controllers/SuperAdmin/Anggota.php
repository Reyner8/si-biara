<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class Anggota extends BaseController
{
    protected $RelationTable;
    protected $AnggotaModel;
    protected $KomunitasModel;
    protected $PenugasanModel;
    protected $PembinaanModel;
    protected $TahapPembinaanModel;
    protected $HasilBelajarModel;


    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->AnggotaModel = new \App\Models\AnggotaModel();
        $this->PenugasanModel = new \App\Models\PenugasanModel();
        $this->PembinaanModel = new \App\Models\PembinaanModel();
        $this->KomunitasModel = new \App\Models\KomunitasModel();
        $this->TahapPembinaanModel = new \App\Models\TahapPembinaan();
        $this->HasilBelajarModel = new \App\Models\HasilBelajarModel();
    }

    public function index()
    {
        $nomorBajuTerakhir = $this->AnggotaModel->orderBy('nomorBaju', 'DESC')->first();
        // dd($nomorBajuTerakhir['nomorBaju']);
        $nomorBajuBaru = sprintf("%04s", $nomorBajuTerakhir['nomorBaju'] + 1);

        return view('superadmin/anggota', [
            'judul' => 'Keanggotaan',
            'nomorBajuBaru' => $nomorBajuBaru,
            'validation' => \Config\Services::validation(),
            'listAnggota' => $this->RelationTable->getAnggotaAllWithoutRole(),
            'komunitas' => $this->KomunitasModel->findAll(),
            'riwayatPenugasan' => $this->RelationTable->riwayatPenugasan(),
            'tahapPembinaan' => $this->RelationTable->tahapPembinaan(),
        ]);
    }

    // route : sa/anggota
    public function save()
    {
        $LastDataAnggota = $this->AnggotaModel->orderBy('nomorBaju', 'DESC')->first();
        $nama = $this->request->getPost('nama');
        $nomorBaju = sprintf("%04s", $LastDataAnggota['nomorBaju'] + 1);
        $tempatLahir = $this->request->getPost('tempatLahir');
        $tanggalLahir = $this->request->getPost('tanggalLahir');
        $password = password_hash(strval($tanggalLahir), PASSWORD_BCRYPT);
        $nomorTelepon = $this->request->getPost('nomorTelepon');
        $status = $this->request->getPost('status');
        $role = $this->request->getPost('role');
        $foto = $this->request->getFile('foto');
        $newName = '';

        // penugasan
        $idKomunitas = $this->request->getPost('idKomunitas');
        $tanggalPenugasan = $this->request->getPost('tanggalPenugasan');
        $keteranganPenugasan = $this->request->getPost('keteranganPenugasan');
        $statusPenugasan = $this->request->getPost('statusPenugasan');

        // pembinaan
        $tanggalPembinaan = $this->request->getPost('tanggalPembinaan');
        $keteranganPembinaan = $this->request->getPost('keteranganPembinaan');
        $statusPembinaan = $this->request->getPost('statusPembinaan');

        $rules = [
            'nama' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'nomorTelepon' => 'required',
            'foto' => [
                'uploaded[foto]',
            ],
            // penugasan
            'idKomunitas' => 'required',
            'tanggalPenugasan' => 'required',
            'keteranganPenugasan' => 'required',
            // pembinaan
            'tanggalPembinaan' => 'required',
            'keteranganPembinaan' => 'required'

        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/anggota')->withInput();
        }

        $getAnggotaByRoleAdmin = $this->RelationTable->getAnggotaByRoleKomunitas($idKomunitas, $role);
        // dd($getAnggotaByRoleAdmin);
        if ($getAnggotaByRoleAdmin && $getAnggotaByRoleAdmin['role'] != 'user') {
            session()->setFlashdata('msg-danger', 'Kepala komunitas hanya boleh satu!!!');
            return redirect()->to('sa/anggota')->withInput();
        }

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = 'foto-' . $foto->getRandomName();
            $foto->move('upload/profil', $newName);
        }

        // dd($foto);

        $anggota = $this->AnggotaModel;
        $anggota->insert([
            'nama' => $nama,
            'nomorBaju' => $nomorBaju,
            'password' => $password,
            'tempatLahir' => $tempatLahir,
            'tanggalLahir' => $tanggalLahir,
            'nomorTelepon' => $nomorTelepon,
            'status' => ($status == 'on') ? 'aktif' : 'non-aktif',
            'role' => $role,
            'foto' => $newName
        ]);
        $idAnggota = $anggota->getInsertID();

        $penugasan = $this->PenugasanModel;
        $penugasan->insert([
            'idKomunitas' => $idKomunitas,
            'idAnggota' => $idAnggota,
            'tanggalPenugasan' => $tanggalPenugasan,
            'keterangan' => $keteranganPenugasan,
            'status' => ($statusPenugasan == 'on') ? 'Y' : 'N'
        ]);

        $pembinaan = $this->PembinaanModel;
        $pembinaan->insert([
            'idAnggota' => $idAnggota,
            'idTahapPembinaan' => '1',
            'tanggalPembinaan' => $tanggalPembinaan,
            'keterangan' => $keteranganPembinaan,
            'status' => ($statusPembinaan == 'on') ? 'Y' : 'N',
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('sa/anggota');
    }


    // route : sa/anggota/(:num)
    public function update($id)
    {
        $nama = $this->request->getPost('nama');
        $tempatLahir = $this->request->getPost('tempatLahir');
        $tanggalLahir = $this->request->getPost('tanggalLahir');
        $nomorTelepon = $this->request->getPost('nomorTelepon');
        $password = $this->request->getPost('password');
        $status = $this->request->getPost('status');
        $role = $this->request->getPost('role');
        $anggota = $this->AnggotaModel->find($id);
        $foto = $this->request->getFile('foto');
        $file = $this->request->getFile('file');
        // dd($file);
        $newName = '';
        $newNameFile = '';

        if (!$password) {
            $password = $anggota['password'];
        }

        $rules = [
            'nama' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'nomorTelepon' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/anggota')->withInput();
        }

        $idKomunitas = $this->RelationTable->getAnggotaByIdAnggota($anggota['id'])['idKomunitas'];

        $getAnggotaByRole = $this->RelationTable->getAnggotaByRoleAndKomunitas($idKomunitas);
        if ($getAnggotaByRole && $role == 'admin') {
            session()->setFlashdata('msg-danger', 'Kepala komunitas hanya boleh satu!!!');
            return redirect()->to('sa/anggota')->withInput();
        }

        if ($foto == '') {
            $newName = $anggota['foto'];
        }

        if ($file == '') {
            $newNameFile = $anggota['berkasTerkait'];
        }

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = 'foto-' . $foto->getRandomName();
            $foto->move('upload/profil', $newName);
            unlink('upload/profil/' . $anggota['foto']);
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'file-' . $file->getRandomName();
            $file->move('upload/berkas', $newName);
            unlink('upload/berkas/' . $anggota['berkasTerkait']);
        }

        $this->AnggotaModel->update($id, [
            'nama' => $nama,
            'password' => $password,
            'tempatLahir' => $tempatLahir,
            'tanggalLahir' => $tanggalLahir,
            'nomorTelepon' => $nomorTelepon,
            'status' => $status,
            'berkasTerkait' => $newNameFile,
            'role' => $role,
            'foto' => $newName
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/anggota');
    }

    // route : sa/anggota/detail/(:num)
    public function detail($idAnggota)
    {
        // dd($idAnggota);
        // dd($this->RelationTable->getAnggotaById($idAnggota));
        return view('superAdmin/detailAnggota', [
            'judul' => 'Detail Anggota',
            'validation' => \Config\Services::validation(),
            'listPenugasan' => $this->RelationTable->listPenugasanByAnggota($idAnggota),
            'listPembinaan' => $this->RelationTable->listPembinaanByAnggota($idAnggota),
            'anggota' => $this->RelationTable->getAnggotaById($idAnggota),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
            'editPenugasan' => $this->PenugasanModel->findAll(),
            'editPembinaan' => $this->PembinaanModel->findAll()
        ]);
    }

    // route : sa/anggota/penugasan/(:num)
    public function savePenugasan($idAnggota)
    {
        $idKomunitas = $this->request->getPost('idKomunitas');
        $tanggalPenugasan = $this->request->getPost('tanggalPenugasan');
        $keteranganPenugasan = $this->request->getPost('keteranganPenugasan');
        $statusPenugasan = $this->request->getPost('statusPenugasan');
        $file = $this->request->getFile('file');

        $rules = [
            'idKomunitas' => 'required',
            'tanggalPenugasan' => 'required',
            'keteranganPenugasan' => 'required',
            'statusPenugasan' => 'required',
            'file' => [
                'uploaded[file]',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/anggota/detail/' . $idAnggota)->withInput();
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'penugasan-' . $file->getRandomName();
            $file->move('upload/penugasan', $newName);
        }

        $this->PenugasanModel->save([
            'idKomunitas' => $idKomunitas,
            'idAnggota' => $idAnggota,
            'tanggalPenugasan' => $tanggalPenugasan,
            'keteranganPenugasan' => $keteranganPenugasan,
            'status' => ($statusPenugasan == 'on') ? 'Y' : 'N',
            'file' => $newName,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/anggota/detail/' . $idAnggota);
    }

    // route : sa/anggota/penugasan/(:num)
    public function updatePenugasan($idAnggota)
    {
        $idPenugasan = $this->request->getPost('idPenugasan');
        $idKomunitas = $this->request->getPost('idKomunitas');
        $tanggalPenugasan = $this->request->getPost('tanggalPenugasan');
        $keteranganPenugasan = $this->request->getPost('keteranganPenugasan');
        $statusPenugasan = $this->request->getPost('statusPenugasan');
        $file = $this->request->getFile('file');

        $rules = [
            'idKomunitas' => 'required',
            'tanggalPenugasan' => 'required',
            'keteranganPenugasan' => 'required',
            'statusPenugasan' => 'required',

        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
            return redirect()->to('sa/anggota/detail/' . $idAnggota)->withInput();
        }

        $penugasan = $this->PenugasanModel->find($idPenugasan);

        if ($file == '') {
            $newName = $penugasan['file'];
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'penugasan-' . $file->getRandomName();
            // $file->move('upload/penugasan', $newName);
        }
        dd($newName);
        $this->PenugasanModel->update($idPenugasan, [
            'idKomunitas' => $idKomunitas,
            'idAnggota' => $idAnggota,
            'tanggalPenugasan' => $tanggalPenugasan,
            'keterangan' => $keteranganPenugasan,
            'status' => ($statusPenugasan == 'on') ? 'Y' : 'T',
            'file' => $newName,
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
        return redirect()->to('sa/anggota/detail/' . $idAnggota);
    }

    // route : sa/anggota/pembinaan/(:num)
    public function savePembinaan($idAnggota)
    {
        $idTahapPembinaan = $this->request->getPost('idTahapPembinaan');
        $tanggalPembinaan = $this->request->getPost('tanggalPembinaan');
        $keteranganPembinaan = $this->request->getPost('keteranganPembinaan');
        $statusPembinaan = $this->request->getPost('statusPembinaan');

        $rules = [
            'idTahapPembinaan' => 'required',
            'tanggalPembinaan' => 'required',
            'keteranganPembinaan' => 'required',
            'statusPembinaan' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/anggota/detail/' . $idAnggota)->withInput();
        }

        $this->PembinaanModel->save([
            'idAnggota' => $idAnggota,
            'idTahapPembinaan' => $idTahapPembinaan,
            'tanggalPembinaan' => $tanggalPembinaan,
            'keterangan' => $keteranganPembinaan,
            'status' => $statusPembinaan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/anggota/detail/' . $idAnggota);
    }

    // route : sa/anggota/pembinaan/(:num)
    public function updatePembinaan($idAnggota)
    {
        $idPembinaan = $this->request->getPost('idPembinaan');
        $idTahapPembinaan = $this->request->getPost('idTahapPembinaan');
        $tanggalPembinaan = $this->request->getPost('tanggalPembinaan');
        $keteranganPembinaan = $this->request->getPost('keteranganPembinaan');
        $statusPembinaan = $this->request->getPost('statusPembinaan');

        $rules = [
            'idTahapPembinaan' => 'required',
            'tanggalPembinaan' => 'required',
            'keteranganPembinaan' => 'required',
            'statusPembinaan' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/anggota/detail/' . $idAnggota)->withInput();
        }

        $this->PembinaanModel->update($idPembinaan, [
            'idAnggota' => $idAnggota,
            'idTahapPembinaan' => $idTahapPembinaan,
            'tanggalPembinaan' => $tanggalPembinaan,
            'keterangan' => $keteranganPembinaan,
            'status' => $statusPembinaan,
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
        return redirect()->to('sa/anggota/detail/' . $idAnggota);
    }

    // route : admin/anggota/(:num)
    public function delete($id)
    {
        unlink('upload/profil/' . $this->AnggotaModel->find($id)['foto']);
        $this->AnggotaModel->delete($id);
        $this->PenugasanModel->where('idAnggota', $id)->delete();
        $this->PembinaanModel->where('idAnggota', $id)->delete();
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('sa/anggota');
    }


    // route : admin/anggota/penugasan/(:num)
    public function deletePenugasan($idPenugasan)
    {
        $idAnggota = $this->PenugasanModel->find($idPenugasan)['idAnggota'];
        $this->PenugasanModel->delete($idPenugasan);
        return redirect()->to('sa/anggota/detail/' . $idAnggota);
    }

    // route : admin/anggota/pembinaan/(:num)
    public function deletePembinaan($idPembinaan)
    {
        $idAnggota = $this->PembinaanModel->find($idPembinaan)['idAnggota'];
        $this->PembinaanModel->delete($idPembinaan);
        return redirect()->to('sa/anggota/detail/' . $idAnggota);
    }


    // route : admin/anggota/profil
    public function profil()
    {
        return view('admin/profil', [
            'judul' => 'Profil Anda',
            'validation' => \Config\Services::validation(),
            'profil' => $this->AnggotaModel->find(session()->get('idAnggota')),
        ]);
    }

    // route : admin/anggota/profil
    public function updateProfil()
    {
        $idAnggota = session()->get('idAnggota');
        $nama = $this->request->getPost('nama');
        $tempatLahir = $this->request->getPost('tempatLahir');
        $tanggalLahir = $this->request->getPost('tanggalLahir');
        $nomorTelepon = $this->request->getPost('nomorTelepon');
        $password = $this->request->getPost('password');

        $newPassword = '';

        $rules = [
            'nama' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'nomorTelepon' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/anggota/profil')->withInput();
        }

        if ($password == '') {
            $newPassword = $this->AnggotaModel->find($idAnggota)['password'];
        } else {
            $newPassword = password_hash(strval($password), PASSWORD_BCRYPT);
        }

        $anggota = $this->AnggotaModel;
        $anggota->update($idAnggota, [
            'nama' => $nama,
            'password' => $newPassword,
            'tempatLahir' => $tempatLahir,
            'tanggalLahir' => $tanggalLahir,
            'nomorTelepon' => $nomorTelepon,
        ]);

        session()->setFlashdata('msg-success', 'Profil berhasil diubah!!!');
        return redirect()->to('admin/anggota/profil');
    }

    public function updateProfilImage()
    {
        $idAnggota = session()->get('idAnggota');
        $foto = $this->request->getFile('foto');


        $rules = [
            'foto' => [
                'uploaded[foto]',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Foto Gagal diubah !!!');
            return redirect()->to('admin/anggota/profil')->withInput();
        }

        if ($foto->getName() == '') {
            $newFoto = $this->AnggotaModel->find($idAnggota)['foto'];
        }

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newFoto = 'foto-' . $foto->getRandomName();
            $foto->move('upload/profil', $newFoto);
        }

        $anggota = $this->AnggotaModel;
        $anggota->update($idAnggota, [
            'foto' => $newFoto
        ]);

        session()->setFlashdata('msg-success', 'Profil berhasil diubah!!!');
        return redirect()->to('admin/anggota/profil');
    }

    // route : sa/anggota/belajar/(:num)
    public function student($idAnggota)
    {
        // dd($this->HasilBelajarModel->where('idAnggota', $idAnggota)->findAll());
        return view('superAdmin/hasilBelajar', [
            'judul' => 'Hasil Belajar',
            'validation' => \Config\Services::validation(),
            'listHasilBelajar' => $this->HasilBelajarModel->where('idAnggota', $idAnggota)->findAll(),
            'anggota' => $this->RelationTable->getAnggotaById($idAnggota),
        ]);
    }

    function studentSave($idAnggota)
    {
        $universitas = $this->request->getPost('universitas');
        $fakultas = $this->request->getPost('fakultas');
        $prodi = $this->request->getPost('prodi');
        $jenjang = $this->request->getPost('jenjang');
        $file = $this->request->getFile('file');

        $rules = [
            'universitas' => 'required',
            'fakultas' => 'required',
            'prodi' => 'required',
            'jenjang' => 'required',
            'file' => [
                'uploaded[file]',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/anggota/belajar/' . $idAnggota)->withInput();
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'hasilBelajar-' . $file->getRandomName();
            $file->move('upload/belajar', $newName);
        }

        $this->HasilBelajarModel->save([
            'idAnggota' => $idAnggota,
            'universitas' => $universitas,
            'fakultas' => $fakultas,
            'prodi' => $prodi,
            'jenjang' => $jenjang,
            'file' => $newName,
        ]);

        session()->setFlashdata('msg', 'Data berhasil ditambahkan!!!');
        return redirect()->to('sa/anggota/belajar/' . $idAnggota);
    }

    public function studentDelete($id)
    {
        $idAnggota = $this->HasilBelajarModel->find($id)['idAnggota'];
        $this->HasilBelajarModel->delete($id);
        return redirect()->to('sa/anggota/belajar/' . $idAnggota);
    }
}
