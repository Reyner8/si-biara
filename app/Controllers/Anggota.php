<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Anggota extends BaseController
{
    protected $RelationTable;
    protected $KomunitasModel;


    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->KomunitasModel = new \App\Models\KomunitasModel();
    }

    // route : anggota
    public function index()
    {
        return view('anggota', [
            'judul' => 'Keanggotaan Biara SJMJ',
            'listAnggota' => $this->RelationTable->getAnggotaAllWithoutRole(),
            'komunitas' => $this->KomunitasModel->findAll(),
        ]);
    }

    // route : anggota/(:num)
    public function detail($idAnggota)
    {
        return view('detailAnggota', [
            'judul' => 'Detail Anggota',
            'listPenugasan' => $this->RelationTable->listPenugasanByAnggota($idAnggota),
            'listPembinaan' => $this->RelationTable->listPembinaanByAnggota($idAnggota),
            'anggota' => $this->RelationTable->getAnggotaById($idAnggota),
        ]);
    }
}
