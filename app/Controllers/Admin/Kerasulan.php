<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kerasulan extends BaseController
{

  protected $KerasulanModel;
  protected $JenisKerasulanModel;
  protected $RelationTable;
  protected $KomunitasModel;

  public function __construct()
  {
    $this->KerasulanModel = new \App\Models\KerasulanModel();
    $this->JenisKerasulanModel = new \App\Models\JenisKerasulanModel();
    $this->RelationTable = new \App\Models\RelationTable();
    $this->KomunitasModel = new \App\Models\KomunitasModel();
  }

  public function index()
  {
    return view('admin/kerasulan', [
      'judul' => 'Kerasulan',
      'validation' => \Config\Services::validation(),
      'listKerasulan' => $this->RelationTable->listKerasulanByKomunitas(session()->get('komunitas')),
      'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
      'isEdit' => false
    ]);
  }

  // route : /sa/kerasulan/edit/(:num)
  public function edit($id)
  {
    return view('admin/kerasulan', [
      'judul' => 'Kerasulan',
      'validation' => \Config\Services::validation(),
      'dataEdit' => $this->KerasulanModel->find($id),
      'listKerasulan' => $this->RelationTable->listKerasulanByKomunitas(session()->get('komunitas')),
      'listJenisKerasulan' => $this->JenisKerasulanModel->findAll(),
      'isEdit' => true
    ]);
  }

  // route : /sa/kerasulan
  public function save()
  {
    $idKomunitas = session()->get('komunitas');
    $idJenisKerasulan = $this->request->getPost('idJenisKerasulan');
    $namaLembaga = $this->request->getPost('namaLembaga');
    $tanggalBerdiri = $this->request->getPost('tanggalBerdiri');
    $keterangan = $this->request->getPost('keterangan');

    $rules = [
      'idJenisKerasulan' => 'required',
      'namaLembaga' => 'required',
      'tanggalBerdiri' => 'required',
      'keterangan' => 'required',
    ];

    if (!$this->validate($rules)) {
      session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
      return redirect()->to('admin/kerasulan')->withInput();
    }

    $this->KerasulanModel->insert([
      'idKomunitas' => $idKomunitas,
      'idJenisKerasulan' => $idJenisKerasulan,
      'namaLembaga' => $namaLembaga,
      'tanggalBerdiri' => $tanggalBerdiri,
      'keterangan' => $keterangan,
    ]);

    session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
    return redirect()->to('admin/kerasulan');
  }

  // route : admin/kerasulan/edit/(:num)
  public function update($id)
  {
    $idKomunitas = session()->get('komunitas');
    $idJenisKerasulan = $this->request->getPost('idJenisKerasulan');
    $namaLembaga = $this->request->getPost('namaLembaga');
    $tanggalBerdiri = $this->request->getPost('tanggalBerdiri');
    $keterangan = $this->request->getPost('keterangan');


    $rules = [
      'idJenisKerasulan' => 'required',
      'namaLembaga' => 'required',
      'tanggalBerdiri' => 'required',
      'keterangan' => 'required',
    ];


    if (!$this->validate($rules)) {
      session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
      return redirect()->to('admin/kerasulan/edit/' . $id)->withInput();
    }

    $this->KerasulanModel->update($id, [
      'idKomunitas' => $idKomunitas,
      'idJenisKerasulan' => $idJenisKerasulan,
      'namaLembaga' => $namaLembaga,
      'tanggalBerdiri' => $tanggalBerdiri,
      'keterangan' => $keterangan,
    ]);

    session()->setFlashdata('msg-success', 'Data berhasil diubah!!!');
    return redirect()->to('admin/kerasulan');
  }

  // route : admin/kerasulan/(:num)
  public function delete($id)
  {
    $this->KerasulanModel->delete($id);
    session()->setFlashdata('msg-success', 'Data berhasil dihapus!!!');
    return redirect()->to('admin/kerasulan');
  }
}
