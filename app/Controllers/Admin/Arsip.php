<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Arsip extends BaseController
{
    protected $RelationTable;
    protected $ArsipKomunitasModel;
    protected $KomunitasModel;

    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->ArsipKomunitasModel = new \App\Models\ArsipKomunitasModel();
        $this->KomunitasModel = new \App\Models\KomunitasModel();
    }

    public function index()
    {
        $idKomunitas = session()->get('komunitas');
        return view('admin/arsip', [
            'judul' => 'Arsip',
            'listArsip' => $this->ArsipKomunitasModel->where('idKomunitas', $idKomunitas)->findAll(),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'validation' => \Config\Services::validation(),
        ]);
    }

    // route : admin/arsip
    public function save()
    {
        $nama = $this->request->getPost('nama');
        $tanggal = $this->request->getPost('tanggal');
        $jenisFile = $this->request->getPost('jenisFile');
        $idKomunitas = session()->get('komunitas');
        $file = $this->request->getFile('file');
        $rules = [
            'nama' => 'required',
            'tanggal' => 'required',
            'jenisFile' => 'required',
            'file' => [
                'uploaded[file]',
            ],
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/arsip')->withInput();
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'arsip-' . $file->getRandomName();
            $file->move('upload/berkas', $newName);
        }

        $arsip = $this->ArsipKomunitasModel;
        $arsip->insert([
            'idKomunitas' => $idKomunitas,
            'nama' => $nama,
            'tanggal' => $tanggal,
            'jenisFile' => $jenisFile,
            'file' => $newName
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('admin/arsip');
    }

    // route : admin/arsip/(:num)
    public function update($id)
    {

        $nama = $this->request->getPost('nama');
        $tanggal = $this->request->getPost('tanggal');
        $jenisFile = $this->request->getPost('jenisFile');
        $idKomunitas = session()->get('komunitas');
        $file = $this->request->getFile('file');
        // dd($jenisFile);
        $rules = [
            'nama' => 'required',
            'tanggal' => 'required',
            'jenisFile' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
            return redirect()->to('admin/arsip')->withInput();
        }

        $arsip = $this->ArsipKomunitasModel->find($id);

        if ($file == '') {
            $newName = $arsip['file'];
        }

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = 'berkas-' . $file->getRandomName();
            $file->move('upload/berkas', $newName);
            unlink('upload/berkas/' . $arsip['file']);
        }

        $this->ArsipKomunitasModel->update($id, [
            'idKomunitas' => $idKomunitas,
            'nama' => $nama,
            'tanggal' => $tanggal,
            'jenisFile' => $jenisFile,
            'foto' => $newName
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('admin/arsip');
    }


    // route : admin/arsip/(:num)
    public function delete($id)
    {
        unlink('upload/berkas/' . $this->ArsipKomunitasModel->find($id)['file']);
        $this->ArsipKomunitasModel->delete($id);
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('admin/arsip');
    }
}
