<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class Arsip extends BaseController
{
    protected $RelationTable;
    protected $ArsipModel;
    protected $ProvinsiModel;

    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->ArsipModel = new \App\Models\ArsipModel();
        $this->ProvinsiModel = new \App\Models\ProvinsiModel();
    }

    public function index()
    {
        $superAdminData = (session()->get('role') == 'superadmin') ? $this->RelationTable->getProvinsiByIdKomunitas(session()->get('komunitas')) : '';
        // dd($superAdminData);
        return view('superadmin/arsip', [
            'judul' => 'Arsip',
            'listArsip' => $this->RelationTable->getArsip(),
            'listProvinsi' => $this->ProvinsiModel->findAll(),
            'superAdminData' => $superAdminData,
            'validation' => \Config\Services::validation(),
        ]);
    }

    // route : sa/arsip
    public function save()
    {

        $nama = $this->request->getPost('nama');
        $tanggal = $this->request->getPost('tanggal');
        $jenisFile = $this->request->getPost('jenisFile');
        $idProvinsi = $this->request->getPost('idProvinsi');
        $file = $this->request->getFile('file');

        // $idProvinsi = $this->RelationTable->getProvinsiByIdKomunitas(session()->get('komunitas'))['id'];
        $rules = [
            'nama' => 'required',
            'tanggal' => 'required',
            'jenisFile' => 'required',
            // 'idProvinsi' => 'required',
            'file' => [
                'uploaded[file]',
            ],

        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/arsip')->withInput();
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'arsip-' . $file->getRandomName();
            $file->move('upload/berkas', $newName);
        }

        $arsip = $this->ArsipModel;
        $arsip->insert([
            'idProvinsi' => $idProvinsi,
            'nama' => $nama,
            'tanggal' => $tanggal,
            'jenisFile' => $jenisFile,
            'file' => $newName
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('sa/arsip');
    }

    // route : sa/arsip/(:num)
    public function update($id)
    {


        $nama = $this->request->getPost('nama');
        $tanggal = $this->request->getPost('tanggal');
        $jenisFile = $this->request->getPost('jenisFile');
        $idProvinsi = $this->request->getPost('idProvinsi');
        $file = $this->request->getFile('file');

        // dd($jenisFile);


        $rules = [
            'nama' => 'required',
            'tanggal' => 'required',
            'jenisFile' => 'required',
            'idProvinsi' => 'required',

        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
            return redirect()->to('sa/arsip')->withInput();
        }

        $arsip = $this->ArsipModel->find($id);

        if ($file == '') {
            $newName = $arsip['file'];
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'berkas-' . $file->getRandomName();
            $file->move('upload/berkas', $newName);
            unlink('upload/berkas/' . $arsip['file']);
        }

        $this->ArsipModel->update($id, [
            'idProvinsi' => $idProvinsi,
            'nama' => $nama,
            'tanggal' => $tanggal,
            'jenisFile' => $jenisFile,
            'foto' => $newName
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/arsip');
    }


    // route : sa/arsip/(:num)
    public function delete($id)
    {
        unlink('upload/berkas/' . $this->ArsipModel->find($id)['file']);
        $this->ArsipModel->delete($id);
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('sa/arsip');
    }
}
