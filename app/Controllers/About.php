<?php

namespace App\Controllers;

class About extends BaseController
{
    protected $ProvinsiModel;
    protected $RelationTable;

    public function __construct()
    {
        $this->ProvinsiModel = new \App\Models\ProvinsiModel();
        $this->RelationTable = new \App\Models\RelationTable();
    }

    // route : about
    public function index()
    {
        return view('about', [
            'judul' => 'About',
            'provinsi' => $this->ProvinsiModel->findAll(),
            'riwayatPemimpinProvinsi' => $this->RelationTable->getRiwayatPemimpinProvinsi()
        ]);
    }
}
