<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class JenisKerasulan extends BaseController
{
    protected $JenisKerasulanModel;

    public function __construct()
    {
        $this->JenisKerasulanModel = new \App\Models\JenisKerasulanModel();
    }

    public function index()
    {
        return view('superadmin/jenisKerasulan', [
            'judul' => 'Jenis Kerasulan',
            'validation' => \Config\Services::validation(),
            'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
            'isEdit' => false
        ]);
    }

    public function editPage($id)
    {
        return view('superadmin/jenisKerasulan', [
            'judul' => 'Jenis Kerasulan',
            'validation' => \Config\Services::validation(),
            'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
            'dataEdit' => $this->JenisKerasulanModel->find($id),
            'isEdit' => true
        ]);
    }

    // route : sa/jenisKerasulan/(:num)
    public function update($id)
    {
        $keterangan = $this->request->getPost('keterangan');

        if (!$this->validate([
            'keterangan' => 'required',
        ])) {
            session()->setFlashdata('msg-danger', 'Data berhasil diubah!!!');
            return redirect()->to('sa/jenisKerasulan/edit/' . $id)->withInput();
        }

        $this->JenisKerasulanModel->update($id, [
            'keterangan' => $keterangan,
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
        return redirect()->to('sa/jenisKerasulan');
    }
}
