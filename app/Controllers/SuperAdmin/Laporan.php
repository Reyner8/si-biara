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
    $this->KerasulanModel = new \App\Models\KerasulanModel();
    $this->TahapPembinaanModel = new \App\Models\TahapPembinaanModel();
    $this->HasilBelajarModel = new \App\Models\HasilBelajarModel();
  }

  public function index()
  {
    return view('superadmin/laporan', [
      'judul' => 'Laporan',
      'validation' => \Config\Services::validation(),
      'tahapPembinaan' => $this->TahapPembinaanModel->findAll(),
      'komunitas' => $this->KomunitasModel->findAll()
    ]);
  }

  function dataSuster()
  {
    $status = $this->request->getPost('status');
    $listAnggota = $this->RelationTable->dataAnggotaAll($status);

    // dd('test');
    $dompdf = new Dompdf();

    $html = view('superadmin/laporan/dataSuster', [
      'namaLaporan' => 'Laporan Data Suster (' . $status . ')',
      'listSuster' => $listAnggota,
      'status' => ($status == 'meninggal') ? 'meninggal' : ''
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

  function dataPenugasan()
  {
    $idKomunitas = $this->request->getPost('idKomunitas');
    $namaKomunitas = $this->KomunitasModel->find($idKomunitas);
    // dd($idKomunitas);
    // dd($this->RelationTable->getAnggotaPenugasanByKomunitas($idKomunitas));
    $dompdf = new Dompdf();

    $html = view('superadmin/laporan/dataPenugasan', [
      'namaLaporan' => 'Laporan Data Penugasan di ' . $namaKomunitas['nama'],
      'listPenugasan' => $this->RelationTable->getAnggotaPenugasanByKomunitas($idKomunitas),
    ]);
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }

  function dataPembinaan()
  {
    $idPembinaan = $this->request->getPost('idPembinaan');
    $namaPembinaan = $this->TahapPembinaanModel->find($idPembinaan)['nama'];
    // dd('test');
    $dompdf = new Dompdf();
    $html = view('superadmin/laporan/dataPembinaan', [
      'namaLaporan' => 'Laporan Data Pembinaan di ' . $namaPembinaan,
      'listPembinaan' => $this->RelationTable->getAnggotaPembinaanByidPembinaan($idPembinaan),
      'komunitas' => $this->TahapPembinaanModel->findAll(),
    ]);

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }
}
