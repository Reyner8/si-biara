<?php

namespace App\Controllers\superuser;

use App\Controllers\BaseController;

class Kegiatan extends BaseController
{
    protected $KegiatanModel;

    public function __construct()
    {
        $this->KegiatanModel = new \App\Models\KegiatanModel();
        $this->GaleriModel = new \App\Models\GaleriModel();
    }

    public function index()
    {
        $data = ['judul' => 'Kegiatan Komunitas'];
        return view('admin/beranda', $data);
    }

    public function save()
    {
        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $foto = $this->request->getFileMultiple('foto');

        if (!$this->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required'
        ])) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/komunitas')->withInput();
        }

        $this->KegiatanModel->insert([
            'judul' =>  $judul,
            'deskripsi' =>  $deskripsi,
            'tanggal' =>  date('YYYY-mm-dd')
        ]);

        $id = $this->KegiatanModel->getInsertID();


        if ($imageFile = $this->request->getFiles()) {
            foreach ($imageFile['foto'] as $image) {
                if ($image->isValid() && !$image->hasMoved()) {
                    $newName = $image->getRandomName();
                    $image->move(WRITEPATH . 'upload/galeri', $newName);
                    $this->GaleriModel->insert(['idKegiatan' => $id, 'foto' => $newName]);
                }
            }
        }
    }
}
