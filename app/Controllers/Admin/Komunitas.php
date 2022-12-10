<?php

namespace App\Controllers\Superuser;

use App\Controllers\BaseController;

class Komunitas extends BaseController
{
    protected $KomunitasModel;

    public function __construct()
    {
        $this->KomunitasModel = new \App\Models\KomunitasModel();
    }

    public function index()
    {
        return view('superuser/komunitas', [
            'judul' => 'Komunitas',
            'validation' => \Config\Services::validation(),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'isEdit' => false
        ]);
    }

    // route : superuser/komunitas
    public function save()
    {

        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $tanggalBerdiri = $this->request->getPost('tanggalBerdiri');
        $status = $this->request->getPost('status');


        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'tanggalBerdiri' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('superuser/komunitas')->withInput();
        }

        $this->KomunitasModel->save([
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggalBerdiri' => $tanggalBerdiri,
            'status' => $status
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('superuser/komunitas');
    }

    // route : superuser/komunitas/edit/(:num)
    public function editPage($id)
    {
        return view('superuser/komunitas', [
            'judul' => 'Komunitas',
            'validation' => \Config\Services::validation(),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'dataEdit' => $this->KomunitasModel->find($id),
            'isEdit' => true
        ]);
    }

    // route : superuser/komunitas/edit/(:num)
    public function update($id)
    {
        $nama = $this->request->getPost('nama');
        $alamat = $this->request->getPost('alamat');
        $tanggalBerdiri = $this->request->getPost('tanggalBerdiri');
        $status = $this->request->getPost('status');

        $rules = [
            'nama' => 'required',
            'alamat' => 'required',
            'tanggalBerdiri' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('superuser/komunitas/edit/' . $id)->withInput();
        }

        $this->mod->update($id, [
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggalBerdiri' => $tanggalBerdiri,
            'status' => $status,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('superuser/komunitas');
    }

    // route : superuser/komunitas/(:num)
    public function delete($id)
    {
        $this->KomunitasModel->delete($id);
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('superuser/komunitas');
    }
}
