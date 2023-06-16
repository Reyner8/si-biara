<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Penugasan extends BaseController
{
    protected $RelationTable;
    protected $AnggotaModel;
    protected $KomunitasModel;

    public function __construct()
    {
        $this->RelationTable = new \App\Models\RelationTable();
        $this->AnggotaModel = new \App\Models\AnggotaModel();
        $this->KomunitasModel = new \App\Models\KomunitasModel();
    }

    public function index()
    {
        // dd($this->RelationTable->getAnggota());
        return view('admin/penugasan', [
            'judul' => 'Penugasan',
            'listAnggota' => $this->RelationTable->getAnggota(),
            'anggota' => $this->AnggotaModel->findAll(),
            'riwayatPenugasan' => $this->RelationTable->getPenugasan(),
            'komunitas' => $this->KomunitasModel->findAll()
        ]);
    }

    // route : admin/penugasan/(:num)
    public function save($idAnggota)
    {
        $komunitas = $this->request->getPost('komunitas');
        $tanggalPenugasan = $this->request->getPost('tanggalPenugasan');
        $keterangan = $this->request->getPost('keterangan');

        $rules = [
            'komunitas' => 'required',
            'tanggalPenugasan' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('admin/penugasan');
        }

        $this->RelationTable->insertPenugasan([
            'idKomunitas' => $komunitas,
            'idAnggota' => $idAnggota,
            'tanggalPenugasan' => $tanggalPenugasan,
            'keterangan' => $keterangan,
        ]);

        session()->setFlashdata('msg', 'Data berhasil diubah!!!');
        return redirect()->to('admin/penugasan');
    }

    // route : admin/penugasan/(:num)
    public function delete($id)
    {
        $this->RelationTable->deletePenugasan($id);
        session()->setFlashdata('msg', 'Data berhasil dihapus!!!');
        return redirect()->to('admin/penugasan');
    }
}
