<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class TahapPembinaan extends BaseController
{
    protected $TahapPembinaanModel;

    public function __construct()
    {
        $this->TahapPembinaanModel = new \App\Models\TahapPembinaanModel();
    }

    public function index()
    {
        return view('superadmin/tahapPembinaan', [
            'judul' => 'Tahap Pembinaan',
            'validation' => \Config\Services::validation(),
            'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
            'isEdit' => false
        ]);
    }

    public function editPage($id)
    {
        return view('superadmin/tahapPembinaan', [
            'judul' => 'Tahap Pembinaan',
            'validation' => \Config\Services::validation(),
            'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
            'dataEdit' => $this->TahapPembinaanModel->find($id),
            'isEdit' => true
        ]);
    }

    // route : sa/tahapPembinaan/(:num)
    public function update($id)
    {
        $keterangan = $this->request->getPost('keterangan');

        if (!$this->validate([
            'keterangan' => 'required',
        ])) {
            session()->setFlashdata('msg', 'Data gagal diubah!!!');
            return redirect()->to('sa/tahapPembinaan/edit/' . $id)->withInput();
        }

        $this->TahapPembinaanModel->update($id, [
            'keterangan' => $keterangan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/tahapPembinaan');
    }
}
