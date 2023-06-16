<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class kerasulan extends BaseController
{

  protected $KerasulanModel;
  protected $JenisKerasulanModel;
  protected $RelationTable;

  public function __construct()
  {
    $this->KerasulanModel = new \App\Models\KerasulanModel();
    $this->JenisKerasulanModel = new \App\Models\JenisKerasulanModel();
    $this->RelationTable = new \App\Models\RelationTable();
  }

  // route : /kerasulan
  public function index()
  {
    return view('kerasulan', [
      'judul' => 'Kerasulan',
      'listKerasulan' => $this->RelationTable->listKerasulan(),
      'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
    ]);
  }
}
