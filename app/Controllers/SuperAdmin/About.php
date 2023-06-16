<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class About extends BaseController
{
    protected $RelationTable;
    protected $AboutModel;

    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->AboutModel = new \App\Models\AboutModel();
    }

    public function index()
    {
        return view('superadmin/about', [
            'judul' => 'About',
            'editAbout' => $this->AboutModel->first(),
            'validation' => \Config\Services::validation(),
        ]);
    }

    // route : sa/about
    public function save()
    {

        $sejarah = $this->request->getPost('sejarah');
        $visi = $this->request->getPost('visi');
        $misi = $this->request->getPost('misi');

        $rules = [
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('sa/about')->withInput();
        }

        $about = $this->AboutModel;
        $about->insert([
            'sejarah' => $sejarah,
            'visi' => $visi,
            'misi' => $misi,
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan!!!');
        return redirect()->to('sa/about');
    }

    // route : sa/about/(:num)
    public function update($id)
    {
        $sejarah = $this->request->getPost('sejarah');
        $visi = $this->request->getPost('visi');
        $misi = $this->request->getPost('misi');

        $rules = [
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
            return redirect()->to('sa/about')->withInput();
        }

        $about = $this->AboutModel->find($id);

        $this->AboutModel->update($id, [
            'sejarah' => $sejarah,
            'visi' => $visi,
            'misi' => $misi,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('sa/about');
    }


    // route : sa/about/(:num)
    public function delete($id)
    {
        unlink('upload/berkas/' . $this->AboutModel->find($id)['file']);
        $this->AboutModel->delete($id);
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('sa/about');
    }
}
