<?php

namespace App\Controllers\Superuser;

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
        return view('superuser/jenisKerasulan', [
            'judul' => 'Jenis Kerasulan',
            'validation' => \Config\Services::validation(),
            'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
            'isEdit' => false
        ]);
    }

    public function editPage($id)
    {
        return view('superuser/jenisKerasulan', [
            'judul' => 'Jenis Kerasulan',
            'validation' => \Config\Services::validation(),
            'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
            'dataEdit' => $this->JenisKerasulanModel->find($id),
            'isEdit' => true
        ]);
    }

    // route : superuser/jenisKerasulan/(:num)
    public function update($id)
    {
        $keterangan = $this->request->getPost('keterangan');

        if (!$this->validate([
            'keterangan' => 'required',
        ])) {
            return redirect()->to('superuser/jenisKerasulan/edit/' . $id)->withInput();
        }

        $this->JenisKerasulanModel->update($id, [
            'keterangan' => $keterangan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('superuser/jenisKerasulan');
    }
}
