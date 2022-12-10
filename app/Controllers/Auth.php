<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Auth extends BaseController
{
    public function index()
    {
        // dd(session());
        $data = [
            'judul' => 'Login Page',
            'validation' => \Config\Services::validation(),
        ];

        return view('auth', $data);
    }

    public function login()
    {

        // request form
        $username = $this->request->getPost('nomorBaju');
        $password = $this->request->getPost('password');

        // validation
        $rules = ['nomorBaju' => 'required', 'password' => 'required'];

        // validate form
        if (!$this->validate($rules)) {
            // $validation = \Config\Services::validation();
            return redirect()->to('auth')->withInput();
            // ->with('validation', $validation);
        }

        $AnggotaModel = new \App\Models\AnggotaModel();
        $getDataAnggota = $AnggotaModel->where('nomorBaju', $username)->first();

        // check data valid
        if (!$getDataAnggota) {
            session()->setFlashdata('msg', 'Username atau Password salah!!!');
            return redirect()->to('auth')->withInput();
        }


        // check password valid
        if (!password_verify($password, $getDataAnggota['password'])) {
            session()->setFlashdata('msg', 'Username atau Password salah!!!');
            return redirect()->to('auth')->withInput();
        }

        session()->set([
            'username' => $getDataAnggota['nomorBaju'],
            'role' => $getDataAnggota['role']
        ]);
        if ($getDataAnggota['role'] == 'superuser') {
            return redirect()->to('su/beranda');
        }

        if ($getDataAnggota['role'] == 'admin') {
            return redirect()->to('adm/beranda');
        }

        if ($getDataAnggota['role'] == 'anggota') {
            return redirect()->to('u/beranda');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('auth');
    }
}
