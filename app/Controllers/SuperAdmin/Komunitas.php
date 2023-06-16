<?php

namespace App\Controllers\SuperAdmin;

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
        return view('superAdmin/komunitas', [
            'judul' => 'Komunitas',
            'validation' => \Config\Services::validation(),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'isEdit' => false
        ]);
    }

    // route : sa/komunitas
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
            return redirect()->to('sa/komunitas')->withInput();
        }

        $this->KomunitasModel->save([
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggalBerdiri' => $tanggalBerdiri,
            'status' => $status
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('sa/komunitas');
    }

    // route : sa/komunitas/edit/(:num)
    public function editPage($id)
    {
        return view('superAdmin/komunitas', [
            'judul' => 'Komunitas',
            'validation' => \Config\Services::validation(),
            'listKomunitas' => $this->KomunitasModel->findAll(),
            'dataEdit' => $this->KomunitasModel->find($id),
            'isEdit' => true
        ]);
    }

    // route : sa/komunitas/edit/(:num)
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
            return redirect()->to('sa/komunitas/edit/' . $id)->withInput();
        }

        $this->KomunitasModel->update($id, [
            'nama' => $nama,
            'alamat' => $alamat,
            'tanggalBerdiri' => $tanggalBerdiri,
            'status' => $status,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/komunitas');
    }

    // route : admin/komunitas/(:num)
    public function delete($id)
    {
        $this->KomunitasModel->delete($id);
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('sa/komunitas');
    }
}
