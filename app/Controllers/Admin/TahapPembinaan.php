<?php

namespace App\Controllers\Superuser;

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
        return view('superuser/tahapPembinaan', [
            'judul' => 'Tahap Pembinaan',
            'validation' => \Config\Services::validation(),
            'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
            'isEdit' => false
        ]);
    }

    public function editPage($id)
    {
        return view('superuser/tahapPembinaan', [
            'judul' => 'Tahap Pembinaan',
            'validation' => \Config\Services::validation(),
            'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
            'dataEdit' => $this->TahapPembinaanModel->find($id),
            'isEdit' => true
        ]);
    }

    // route : superuser/tahapPembinaan/(:num)
    public function update($id)
    {
        $keterangan = $this->request->getPost('keterangan');

        if (!$this->validate([
            'keterangan' => 'required',
        ])) {
            return redirect()->to('superuser/tahapPembinaan/edit/' . $id)->withInput();
        }

        $this->TahapPembinaanModel->update($id, [
            'keterangan' => $keterangan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('superuser/tahapPembinaan');
    }
}
