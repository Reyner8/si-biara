<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Komunitas extends BaseController
{

  protected $KomunitasModel;
  protected $RelationTable;

  public function __construct()
  {
    $this->KomunitasModel = new \App\Models\KomunitasModel();
    $this->RelationTable = new \App\Models\RelationTable();
  }

  // route : /kerasulan
  public function index()
  {
    return view('komunitas', [
      'judul' => 'Komunitas',
      'listKomunitas' => $this->KomunitasModel->findAll(),
    ]);
  }
}
