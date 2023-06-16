<?php

namespace App\Controllers;

class About extends BaseController
{
    protected $ProvinsiModel;

    public function __construct()
    {
        $this->ProvinsiModel = new \App\Models\ProvinsiModel();
    }

    // route : about
    public function index()
    {
        return view('about', [
            'judul' => 'About',
            'provinsi' => $this->ProvinsiModel->findAll(),
        ]);
    }
}
