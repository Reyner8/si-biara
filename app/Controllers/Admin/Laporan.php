<?php

namespace App\Controllers\Admin;

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
    return view('Admin/laporan', [
      'judul' => 'Laporan',
      'validation' => \Config\Services::validation(),
    ]);
  }

  function dataSuster()
  {
    // $status = $this->request->getPost('status');
    $listAnggota = $this->RelationTable->dataAnggota();
    // dd($listAnggota);

    // dd('test');
    $dompdf = new Dompdf();

    $html = view('Admin/laporan/dataSuster', [
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


    $html = view('Admin/laporan/dataKerasulan', [
      'namaLaporan' => 'Laporan Data Kerasulan',
      'listKerasulan' => $this->RelationTable->listKerasulanByKomunitas(session()->get('komunitas')),
    ]);
    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream();
  }

  function dataKegiatan()
  {

    // dd($this->RelationTable->getKegiatanByIdKomunitas(session()->get('komunitas')));
    $dompdf = new Dompdf();

    $html = view('Admin/laporan/dataKegiatan', [
      'namaLaporan' => 'Laporan Data Kegiatan',
      'listKegiatan' => $this->RelationTable->getKegiatanByIdKomunitas(session()->get('komunitas')),
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
      $html = view('Admin/laporan/dataPembinaan', [
        'namaLaporan' => 'Laporan Data Pembinaan',
        'listPembinaan' => $this->RelationTable->getAnggotaPembinaan(),
        'listTahapPembinaan' => $this->TahapPembinaanModel->findAll(),
      ]);
    }

    if ($this->request->getPost('penunjang') == 'penugasan') {
      $html = view('Admin/laporan/dataPenugasan', [
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
