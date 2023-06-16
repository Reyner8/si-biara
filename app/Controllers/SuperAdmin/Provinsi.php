<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;

class Provinsi extends BaseController
{

  protected $RelationTable;
  protected $ProvinsiModel;

  public function __construct()
  {
    $this->RelationTable = new \App\Models\RelationTable();
    $this->ProvinsiModel = new \App\Models\ProvinsiModel();
  }

  public function index()
  {
    return view('superadmin/provinsi', [
      'judul' => 'Provinsi',
      'validation' => \Config\Services::validation(),
      'listProvinsi' => $this->ProvinsiModel->findAll(),
      'isEdit' => false
    ]);
  }

  // route : /sa/kerasulan/edit/(:num)
  public function edit($id)
  {
    return view('superadmin/provinsi', [
      'judul' => 'Provinsi',
      'validation' => \Config\Services::validation(),
      'dataEdit' => $this->ProvinsiModel->find($id),
      'listProvinsi' => $this->ProvinsiModel->findAll(),
      'isEdit' => true
    ]);
  }

  // route : /sa/kerasulan
  public function save()
  {
    $nama = $this->request->getPost('nama');
    $visi = $this->request->getPost('visi');
    $misi = $this->request->getPost('misi');
    $sejarahSingkat = $this->request->getPost('sejarahSingkat');

    $rules = [
      'nama' => 'required',
      'visi' => 'required',
      'misi' => 'required',
      'sejarahSingkat' => 'required',
    ];

    if (!$this->validate($rules)) {
      session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
      return redirect()->to('sa/provinsi')->withInput();
    }

    $this->ProvinsiModel->insert([
      'nama' => $nama,
      'visi' => $visi,
      'misi' => $misi,
      'sejarahSingkat' => $sejarahSingkat,
    ]);

    session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
    return redirect()->to('sa/provinsi');
  }

  // route : admin/kerasulan/edit/(:num)
  public function update($id)
  {
    $nama = $this->request->getPost('nama');
    $visi = $this->request->getPost('visi');
    $misi = $this->request->getPost('misi');
    $sejarahSingkat = $this->request->getPost('sejarahSingkat');

    $rules = [
      'nama' => 'required',
      'visi' => 'required',
      'misi' => 'required',
      'sejarahSingkat' => 'required',
    ];

    if (!$this->validate($rules)) {
      session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
      return redirect()->to('sa/provinsi/edit/' . $id)->withInput();
    }
   
    $this->ProvinsiModel->update($id,[
      'nama' => $nama,
      'visi' => $visi,
      'misi' => $misi,
      'sejarahSingkat' => $sejarahSingkat,
    ]);

    session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
    return redirect()->to('sa/provinsi');
  }

  // route : admin/provinsi/(:num)
  public function delete($id)
  {
    $this->ProvinsiModel->delete($id);
    session()->setFlashdata('msg-success', 'Data berhasil dihapus!!!');
    return redirect()->to('sa/provinsi');
  }
}
