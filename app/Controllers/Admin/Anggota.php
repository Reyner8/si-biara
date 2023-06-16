<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Session\Session;

class Anggota extends BaseController
{
    protected $RelationTable;
    protected $AnggotaModel;
    protected $KomunitasModel;
    protected $PenugasanModel;
    protected $PembinaanModel;
    protected $HasilBelajarModel;
    protected $TahapPembinaanModel;


    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->AnggotaModel = new \App\Models\AnggotaModel();
        $this->PenugasanModel = new \App\Models\PenugasanModel();
        $this->PembinaanModel = new \App\Models\PembinaanModel();
        $this->KomunitasModel = new \App\Models\KomunitasModel();
        $this->HasilBelajarModel = new \App\Models\HasilBelajarModel();
        $this->TahapPembinaanModel = new \App\Models\TahapPembinaan();
    }

    public function index()
    {
        $nomorBajuTerakhir = $this->AnggotaModel->orderBy('nomorBaju', 'DESC')->first();
        $splitString = explode('-', $nomorBajuTerakhir['nomorBaju']);
        $nomorBajuBaru = 'B-' . sprintf("%03s", $splitString[1] + 1);
        return view('admin/anggota', [
            'judul' => 'Keanggotaan',
            'nomorBajuBaru' => $nomorBajuBaru,
            'validation' => \Config\Services::validation(),
            'listAnggota' => $this->RelationTable->getAnggotaByKomunitas(session()->get('komunitas')),
            'komunitas' => $this->KomunitasModel->findAll(),
            'riwayatPenugasan' => $this->RelationTable->riwayatPenugasan(),
            'tahapPembinaan' => $this->RelationTable->tahapPembinaan(),
        ]);
    }

    // route : admin/anggota
    public function save()
    {
        $LastDataAnggota = $this->AnggotaModel->orderBy('nomorBaju', 'DESC')->first();
        $splitString = explode('-', $LastDataAnggota['nomorBaju']);

        $nomorBaju = 'B-' . sprintf("%03s", $splitString[1] + 1);
        $nama = $this->request->getPost('nama');
        $tempatLahir = $this->request->getPost('tempatLahir');
        $tanggalLahir = $this->request->getPost('tanggalLahir');
        $nomorTelepon = $this->request->getPost('nomorTelepon');
        $password = password_hash(strval($tanggalLahir), PASSWORD_BCRYPT);
        $foto = $this->request->getFile('foto');
        $newName = '';

        // penugasan
        $idKomunitas = session()->get('komunitas');
        $tanggalPenugasan = $this->request->getPost('tanggalPenugasan');
        $keteranganPenugasan = $this->request->getPost('keteranganPenugasan');

        // pembinaan
        $tanggalPembinaan = $this->request->getPost('tanggalPembinaan');
        $keteranganPembinaan = $this->request->getPost('keteranganPembinaan');

        $rules = [
            'nama' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'nomorTelepon' => 'required',
            'foto' => [
                'uploaded[foto]',
            ],
            // penugasan
            'tanggalPenugasan' => 'required',
            'keteranganPenugasan' => 'required',
            // pembinaan
            'tanggalPembinaan' => 'required',
            'keteranganPembinaan' => 'required'

        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/anggota')->withInput();
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
            'foto' => $newName
        ]);
        $idAnggota = $anggota->getInsertID();

        $penugasan = $this->PenugasanModel;
        $penugasan->insert([
            'idKomunitas' => $idKomunitas,
            'idAnggota' => $idAnggota,
            'tanggalPenugasan' => $tanggalPenugasan,
            'keterangan' => $keteranganPenugasan
        ]);

        $pembinaan = $this->PembinaanModel;
        $pembinaan->insert([
            'idAnggota' => $idAnggota,
            'idTahapPembinaan' => '1',
            'tanggalPembinaan' => $tanggalPembinaan,
            'keterangan' => $keteranganPembinaan,
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('admin/anggota');
    }


    // route : admin/anggota/(:num)
    public function update($id)
    {
        $nama = $this->request->getPost('nama');
        $tempatLahir = $this->request->getPost('tempatLahir');
        $tanggalLahir = $this->request->getPost('tanggalLahir');
        $nomorTelepon = $this->request->getPost('nomorTelepon');
        $password = $this->request->getPost('password');
        $anggota = $this->AnggotaModel->find($id);
        $foto = $this->request->getFile('foto');
        $newName = '';

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
            return redirect()->to('admin/anggota')->withInput();
        }

        if ($foto == '') {
            $newName = $anggota['foto'];
        }

        if ($foto->isValid() && !$foto->hasMoved()) {
            $newName = 'foto-' . $foto->getRandomName();
            $foto->move('upload/profil', $newName);
            unlink('upload/profil/' . $anggota['foto']);
        }

        $this->AnggotaModel->update($id, [
            'nama' => $nama,
            'password' => $password,
            'tempatLahir' => $tempatLahir,
            'tanggalLahir' => $tanggalLahir,
            'nomorTelepon' => $nomorTelepon,
            'foto' => $newName
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('admin/anggota');
    }

    // route : admin/anggota/detail/(:num)
    public function detail($idAnggota)
    {
        return view('admin/detailAnggota', [
            'judul' => 'Detail Anggota',
            'validation' => \Config\Services::validation(),
            'listPenugasan' => $this->RelationTable->listPenugasanByAnggota($idAnggota),
            'listPembinaan' => $this->RelationTable->listPembinaanByAnggota($idAnggota),
            'anggota' => $this->RelationTable->getAnggotaById($idAnggota),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'listTahapPembinaan' => $this->TahapPembinaanModel->findAll()
        ]);
    }

    // route : admin/anggota/penugasan/(:num)
    public function savePenugasan($idAnggota)
    {
        $idKomunitas = $this->request->getPost('idKomunitas');
        $tanggalPenugasan = $this->request->getPost('tanggalPenugasan');
        $keteranganPenugasan = $this->request->getPost('keteranganPenugasan');

        $rules = [
            'idKomunitas' => 'required',
            'tanggalPenugasan' => 'required',
            'keteranganPenugasan' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/anggota/detail/' . $idAnggota)->withInput();
        }

        $this->PenugasanModel->save([
            'idKomunitas' => $idKomunitas,
            'idAnggota' => $idAnggota,
            'tanggalPenugasan' => $tanggalPenugasan,
            'keteranganPenugasan' => $keteranganPenugasan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('admin/anggota/detail/' . $idAnggota);
    }

    // route : admin/anggota/pembinaan/(:num)
    public function savePembinaan($idAnggota)
    {
        $idTahapPembinaan = $this->request->getPost('idTahapPembinaan');
        $tanggalPembinaan = $this->request->getPost('tanggalPembinaan');
        $keteranganPembinaan = $this->request->getPost('keteranganPembinaan');

        $rules = [
            'idTahapPembinaan' => 'required',
            'tanggalPembinaan' => 'required',
            'keteranganPembinaan' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/anggota/detail/' . $idAnggota)->withInput();
        }

        $this->PembinaanModel->save([
            'idAnggota' => $idAnggota,
            'idTahapPembinaan' => $idTahapPembinaan,
            'tanggalPembinaan' => $tanggalPembinaan,
            'keterangan' => $keteranganPembinaan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('admin/anggota/detail/' . $idAnggota);
    }

    // route : admin/anggota/(:num)
    public function delete($id)
    {
        unlink('upload/profil/' . $this->AnggotaModel->find($id)['foto']);
        $this->AnggotaModel->delete($id);
        $this->PenugasanModel->where('idAnggota', $id)->delete();
        $this->PembinaanModel->where('idAnggota', $id)->delete();
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('admin/anggota');
    }


    // route : admin/anggota/penugasan/(:num)
    public function deletePenugasan($idPenugasan)
    {
        $idAnggota = $this->PenugasanModel->find($idPenugasan)['idAnggota'];
        $this->PenugasanModel->delete($idPenugasan);
        return redirect()->to('admin/anggota/detail/' . $idAnggota);
    }

    // route : admin/anggota/pembinaan/(:num)
    public function deletePembinaan($idPembinaan)
    {
        $idAnggota = $this->PembinaanModel->find($idPembinaan)['idAnggota'];
        $this->PembinaanModel->delete($idPembinaan);
        return redirect()->to('admin/anggota/detail/' . $idAnggota);
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
        // dd($this->RelationTable->getAnggotaById($idAnggota));
        return view('admin/hasilBelajar', [
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
            'status' => $jenjang,
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
