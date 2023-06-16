<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Beranda extends BaseController
{

    protected $KegiatanModel;
    protected $GaleriModel;

    public function __construct()
    {
        $this->KegiatanModel = new \App\Models\KegiatanModel();
        $this->GaleriModel = new \App\Models\GaleriModel();
    }

    public function index()
    {
        return view('admin/beranda', [
            'judul' => 'Beranda',
            'listKegiatan' => $this->KegiatanModel->findAll(),
        ]);
    }

    public function detail($id)
    {
        return view('admin/detailBeranda', [
            'judul' => 'Detail Kegiatan',
            'kegiatan' => $this->KegiatanModel->find($id),
            'galeriKegiatan' => $this->GaleriModel->where('idKegiatan', $id)->findAll()
        ]);
    }
}
