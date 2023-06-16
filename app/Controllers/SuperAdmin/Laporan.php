<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Laporan extends BaseController
{

  protected $RelationTable;
  protected $ProvinsiModel;
  protected $AnggotaModel;
  protected $KomunitasModel;
  protected $KerasulanModel;
  protected $TahapPembinaanModel;
  protected $HasilBelajarModel;

  public function __construct()
  {
    $this->RelationTable = new \App\Models\RelationTable();
    $this->ProvinsiModel = new \App\Models\ProvinsiModel();
    $this->AnggotaModel = new \App\Models\AnggotaModel();
    $this->KomunitasModel = new \App\Models\KomunitasModel();
    $this->TahapPembinaanModel = new \App\Models\TahapPembinaanModel();
    $this->HasilBelajarModel = new \App\Models\HasilBelajarModel();
  }

  public function index()
  {
    return view('superadmin/laporan', [
      'judul' => 'Laporan',
      'validation' => \Config\Services::validation(),
    ]);
  }

  function dataSuster()
  {
    $status = $this->request->getPost('status');
    if ($status == 'semua') {
      $listAnggota = $this->AnggotaModel->findAll();
    } else {
      $listAnggota = $this->AnggotaModel->where('status', $status)->findAll();
    }

    // dd('test');
    $dompdf = new Dompdf();

    $html = view('superadmin/laporan/dataSuster', [
      'namaLaporan' => 'Laporan Data Suster',
      'listSuster' => $listAnggota
    ]);
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }

  function dataKomunitas()
  {

    // dd('test');
    $dompdf = new Dompdf();
    if ($this->request->getPost('master') == 'komunitas') {
      $html = view('superadmin/laporan/dataKomunitas', [
        'namaLaporan' => 'Laporan Data Komunitas',
        'listKomunitas' => $this->KomunitasModel->findAll(),
        'listProvinsi' => $this->ProvinsiModel->findAll()
      ]);
    }

    if ($this->request->getPost('master') == 'kerasulan') {
      $html = view('superadmin/laporan/dataKerasulan', [
        'namaLaporan' => 'Laporan Data Kerasulan',
        'listKomunitas' => $this->KomunitasModel->findAll(),
        'listKerasulan' => $this->KerasulanModel->findAll(),
      ]);
    }
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }

  function dataHasilBelajar()
  {

    // dd($this->RelationTable->getHasilBelajar());
    $dompdf = new Dompdf();

    $html = view('superadmin/laporan/dataHasilBelajar', [
      'namaLaporan' => 'Laporan Data Hasil Belajar',
      'listHasilBelajar' => $this->HasilBelajarModel->findAll(),
      'listAnggota' => $this->RelationTable->getHasilBelajar(),
    ]);
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }

  function dataPenunjang()
  {

    // dd('test');
    $dompdf = new Dompdf();
    if ($this->request->getPost('penunjang') == 'pembinaan') {
      $html = view('superadmin/laporan/dataPembinaan', [
        'namaLaporan' => 'Laporan Data Pembinaan',
        'listPembinaan' => $this->RelationTable->getAnggotaPembinaan(),
        'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
      ]);
    }

    if ($this->request->getPost('penunjang') == 'penugasan') {
      $html = view('superadmin/laporan/dataPenugasan', [
        'namaLaporan' => 'Laporan Data Penugasan',
        'listPenugasan' => $this->RelationTable->getAnggotaPenugasan(),
        'listKomunitas' => $this->KomunitasModel->findAll(),
      ]);
    }
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }
}
