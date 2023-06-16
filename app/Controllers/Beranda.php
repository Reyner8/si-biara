<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Beranda extends BaseController
{

  protected $KegiatanModel;
  protected $GaleriModel;
  protected $RelationTable;

  public function __construct()
  {
    $this->KegiatanModel = new \App\Models\KegiatanModel();
    $this->GaleriModel = new \App\Models\GaleriModel();
    $this->RelationTable = new \App\Models\RelationTable();
  }

  public function index()
  {
    return view('beranda', [
      'judul' => 'Beranda',
      'listKegiatan' => $this->RelationTable->getKegiatan(),
      'listGaleri' => $this->GaleriModel->findAll()
    ]);
  }

  public function detail($id)
  {
    return view('user/detailBeranda', [
      'judul' => 'Detail Kegiatan',
      'kegiatan' => $this->KegiatanModel->find($id),
      'galeriKegiatan' => $this->GaleriModel->where('idKegiatan', $id)->findAll()
    ]);
  }
}
