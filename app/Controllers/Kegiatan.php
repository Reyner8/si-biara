<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kegiatan extends BaseController
{
    protected $KegiatanModel;
    protected $GaleriModel;
    protected $GaleriPath;
    protected $dataKegiatan;
    protected $RelationTable;

    public function __construct()
    {
        $this->KegiatanModel = new \App\Models\KegiatanModel();
        $this->RelationTable = new \App\Models\RelationTable();
        $this->GaleriModel = new \App\Models\GaleriModel();
        $this->GaleriPath = 'upload/galeri';
    }

    public function index()
    {
        $data = [
            'judul' => 'Kegiatan',
            'listKegiatan' => $this->RelationTable->listKegiatanNew(),
            'latest' => $this->RelationTable->latestKegiatan(),
        ];
        return view('kegiatan', $data);
    }

    public function detail($id)
    {
        $data = [
            'judul' => 'Detail',
            'kegiatan' => $this->RelationTable->getKegiatanById($id),
            'galeri' => $this->RelationTable->getGaleriById($id)
        ];
        return view('detailKegiatan', $data);
    }
}
