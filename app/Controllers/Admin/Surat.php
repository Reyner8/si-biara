<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Surat extends BaseController
{

  protected $SuratMasukModel;
  protected $SuratKeluarModel;

  public function __construct()
  {
    $this->SuratMasukModel = new \App\Models\SuratMasukModel();
    $this->SuratKeluarModel = new \App\Models\SuratKeluarModel();
  }

  // route : /admin/surat/masuk
  public function suratMasuk()
  {
    return view('admin/suratMasuk', [
      'judul' => 'Surat Masuk',
      'validation' => \Config\Services::validation(),
      'listSuratMasuk' => $this->SuratMasukModel->where('idKomunitas', session()->get('komunitas'))->findAll(),
      'isEdit' => false
    ]);
  }

  // route : /admin/surat/masuk/(:num)
  public function suratMasukEdit($id)
  {
    return view('admin/suratMasuk', [
      'judul' => 'Surat Masuk',
      'validation' => \Config\Services::validation(),
      'listSuratMasuk' => $this->SuratMasukModel->where('idKomunitas', session()->get('komunitas'))->findAll(),
      'dataEdit' => $this->SuratMasukModel->find($id),
      'isEdit' => true
    ]);
  }

  // route : /admin/surat/masuk
  public function suratMasukSave()
  {
    $nomorSurat = $this->request->getPost('nomorSurat');
    $tanggalSurat = $this->request->getPost('tanggalSurat');
    $tanggalTerima = $this->request->getPost('tanggalTerima');
    $pengirim = $this->request->getPost('pengirim');
    $perihal = $this->request->getPost('perihal');
    $file = $this->request->getFile('file');
    $idKomunitas = session()->get('komunitas');

    $rules = [
      'nomorSurat' => 'required',
      'tanggalSurat' => 'required',
      'tanggalTerima' => 'required',
      'pengirim' => 'required',
      'perihal' => 'required',
      'file' => 'uploaded[file]'
    ];

    if (!$this->validate($rules)) {

      session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
      return redirect()->to('admin/surat/masuk')->withInput();
    }

    if ($file->isValid() && !$file->hasMoved()) {
      $newName = 'suratMasuk-' . $file->getRandomName();
      $file->move('upload/surat', $newName);
    }

    $this->SuratMasukModel->insert([
      'nomorSurat' => $nomorSurat,
      'tanggalSurat' => $tanggalSurat,
      'tanggalTerima' => $tanggalTerima,
      'pengirim' => $pengirim,
      'perihal' => $perihal,
      'file' => $file->getName(),
      'idKomunitas' => $idKomunitas
    ]);

    session()->setFlashdata('msg', 'Data berhasil ditambahkan!!!');
    return redirect()->to('admin/surat/masuk');
  }

  // route : /admin/surat/masuk/(:num)
  public function suratMasukUpdate($id)
  {
    $nomorSurat = $this->request->getPost('nomorSurat');
    $tanggalSurat = $this->request->getPost('tanggalSurat');
    $tanggalTerima = $this->request->getPost('tanggalTerima');
    $pengirim = $this->request->getPost('pengirim');
    $perihal = $this->request->getPost('perihal');
    $file = $this->request->getFile('file');
    $idKomunitas = session()->get('komunitas');

    $rules = [
      'nomorSurat' => 'required',
      'tanggalSurat' => 'required',
      'tanggalKirim' => 'required',
      'pengirim' => 'required',
      'perihal' => 'required',
    ];


    if (!$this->validate($rules)) {
      session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
      return redirect()->to('admin/surat/masuk/edit/' . $id)->withInput();
    }

    if (!$file) {
      $newName = $this->SuratMasukModel->find($id)['file'];
    }

    if ($file->isValid() && !$file->hasMoved()) {
      unlink('upload/suratMasuk/' . $this->SuratMasukModel->find($id)['file']);
      $newName = 'suratMasuk-' . $file->getRandomName();
      $file->move('upload/surat', $newName);
    }

    $this->SuratMasukModel->update($id, [
      'nomorSurat' => $nomorSurat,
      'tanggalSurat' => $tanggalSurat,
      'tanggalTerima' => $tanggalTerima,
      'pengirim' => $pengirim,
      'perihal' => $perihal,
      'file' => $newName,
      'idKomunitas' => $idKomunitas
    ]);

    session()->setFlashdata('msg', 'Data berhasil diubah!!!');
    return redirect()->to('admin/surat/masuk');
  }

  // route : /admin/surat/masuk/(:num)
  public function suratMasukDelete($id)
  {
    unlink('upload/surat/' . $this->SuratMasukModel->find($id)['file']);
    $this->SuratMasukModel->delete($id);
    session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
    return redirect()->to('admin/suratMasuk');
  }

  // route : /admin/surat/keluar
  public function suratKeluar()
  {
    return view('admin/suratKeluar', [
      'judul' => 'Surat Keluar',
      'validation' => \Config\Services::validation(),
      'listSuratKeluar' => $this->SuratKeluarModel->where('idKomunitas', session()->get('komunitas'))->findAll(),
      'isEdit' => false
    ]);
  }

  // route : /admin/surat/keluar/(:num)
  public function suratKeluarEdit($id)
  {
    return view('admin/suratKeluar', [
      'judul' => 'Surat Keluar',
      'validation' => \Config\Services::validation(),
      'listSuratKeluar' => $this->SuratKeluarModel->where('idKomunitas', session()->get('komunitas'))->findAll(),
      'dataEdit' => $this->SuratKeluarModel->find($id),
      'isEdit' => true
    ]);
  }

  // route : /admin/surat/keluar
  public function suratKeluarSave()
  {
    $nomorSurat = $this->request->getPost('nomorSurat');
    $tanggalSurat = $this->request->getPost('tanggalSurat');
    $tanggalKirim = $this->request->getPost('tanggalKirim');
    $tujuan = $this->request->getPost('tujuan');
    $perihal = $this->request->getPost('perihal');
    $file = $this->request->getFile('file');
    $idKomunitas = session()->get('komunitas');


    $rules = [
      'nomorSurat' => 'required',
      'tanggalSurat' => 'required',
      'tanggalKirim' => 'required',
      'tujuan' => 'required',
      'perihal' => 'required',
      'file' => 'uploaded[file]'
    ];

    if (!$this->validate($rules)) {

      session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
      return redirect()->to('admin/surat/keluar')->withInput();
    }

    if ($file->isValid() && !$file->hasMoved()) {
      $newName = 'suratKeluar-' . $file->getRandomName();
      $file->move('upload/surat', $newName);
    }


    $this->SuratKeluarModel->insert([
      'nomorSurat' => $nomorSurat,
      'tanggalSurat' => $tanggalSurat,
      'tanggalKirim' => $tanggalKirim,
      'tujuan' => $tujuan,
      'perihal' => $perihal,
      'file' => $file->getName(),
      'idKomunitas' => $idKomunitas
    ]);

    session()->setFlashdata('msg', 'Data berhasil ditambahkan!!!');
    return redirect()->to('admin/surat/keluar');
  }

  // route : /admin/surat/keluar/(:num)
  public function suratKeluarUpdate($id)
  {
    $nomorSurat = $this->request->getPost('nomorSurat');
    $tanggalSurat = $this->request->getPost('tanggalSurat');
    $tanggalKirim = $this->request->getPost('tanggalKirim');
    $tujuan = $this->request->getPost('tujuan');
    $perihal = $this->request->getPost('perihal');
    $file = $this->request->getFile('file');
    $idKomunitas = session()->get('komunitas');
    $newName = '';

    $rules = [
      'nomorSurat' => 'required',
      'tanggalSurat' => 'required',
      'tanggalKirim' => 'required',
      'tujuan' => 'required',
      'perihal' => 'required',
    ];


    if (!$this->validate($rules)) {
      session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
      return redirect()->to('admin/surat/keluar/edit/' . $id)->withInput();
    }
    if ($file->getName() == '') {
      $newName = $this->SuratKeluarModel->find($id)['file'];
    }

    if ($file->isValid() && !$file->hasMoved()) {
      unlink('upload/surat/' . $this->SuratKeluarModel->find($id)['file']);
      $newName = 'suratKeluar-' . $file->getRandomName();
      $file->move('upload/surat', $newName);
    }

    $this->SuratKeluarModel->update($id, [
      'nomorSurat' => $nomorSurat,
      'tanggalSurat' => $tanggalSurat,
      'tanggalKirim' => $tanggalKirim,
      'tujuan' => $tujuan,
      'perihal' => $perihal,
      'file' => $newName,
      'idKomunitas' => $idKomunitas
    ]);

    session()->setFlashdata('msg', 'Data berhasil diubah!!!');
    return redirect()->to('admin/surat/keluar');
  }

  // route : /admin/surat/keluar/(:num)
  public function suratKeluarDelete($id)
  {
    unlink('upload/surat/' . $this->SuratKeluarModel->find($id)['file']);
    $this->SuratKeluarModel->delete($id);
    session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
    return redirect()->to('admin/surat/keluar');
  }
}
