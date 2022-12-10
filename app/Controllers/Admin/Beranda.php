<?php

namespace App\Controllers\superuser;

use App\Controllers\BaseController;

class Beranda extends BaseController
{

    public function index()
    {
        $data = ['judul' => 'Beranda'];
        return view('superuser/beranda', $data);
    }
}
