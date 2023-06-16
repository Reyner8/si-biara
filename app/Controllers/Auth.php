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
            // 'id' => $id
        ];

        return view('auth', $data);
    }

    public function login()
    {

        // request form
        $username = $this->request->getPost('nomorBaju');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        // validation
        $rules = ['nomorBaju' => 'required', 'password' => 'required'];

        // validate form
        if (!$this->validate($rules)) {
            // $validation = \Config\Services::validation();
            return redirect()->to('auth')->withInput();
            // ->with('validation', $validation);
        }

        $AnggotaModel = new \App\Models\AnggotaModel();
        $PenugasanModel = new \App\Models\PenugasanModel();
        $getDataAnggota = $AnggotaModel->where('nomorBaju', $username)->first();
        if ($getDataAnggota) {
            $getPenugasan = $PenugasanModel->where('idAnggota', $getDataAnggota['id'])
                ->orderBy('tanggalPenugasan', 'DESC')
                ->where('penugasan.status', 'Y')
                ->first();
        }

        if ($getDataAnggota['role'] != $role) {
            session()->setFlashdata('msg', 'Username tidak sesuai dengan hak akses anda!!!');
            return redirect()->to('auth')->withInput();
        }

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
        // check user active or not
        if ($getDataAnggota['status'] != 'aktif') {
            session()->setFlashdata('msg', 'Akun anda belum aktif !!!');
            return redirect()->to('auth')->withInput();
        }

        session()->set([
            'idAnggota' => $getDataAnggota['id'],
            'username' => $getDataAnggota['nomorBaju'],
            'komunitas' => ($getPenugasan == null) ? 'none' : $getPenugasan['idKomunitas'],
            'role' => $getDataAnggota['role']
        ]);
        if ($getDataAnggota['role'] == 'superuser' || $getDataAnggota['role'] == 'superadmin') {
            return redirect()->to('sa/beranda');
        } elseif ($getDataAnggota['role'] == 'admin') {
            return redirect()->to('admin/beranda');
        } else {
            return redirect()->to('user/beranda');
        }
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
