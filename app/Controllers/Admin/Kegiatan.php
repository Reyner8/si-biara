<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Kegiatan extends BaseController
{
    protected $KegiatanModel;
    protected $GaleriModel;
    protected $RelationTable;
    protected $GaleriPath;
    protected $dataKegiatan;

    public function __construct()
    {
        $this->KegiatanModel = new \App\Models\KegiatanModel();
        $this->RelationTable = new \App\Models\RelationTable();
        $this->GaleriModel = new \App\Models\GaleriModel();
        $this->GaleriPath = 'upload/galeri';
    }

    public function index()
    {
        $data = [
            'judul' => 'Kegiatan Komunitas',
            'kegiatan' => $this->dataKegiatan,
            'validation' => \Config\Services::validation(),
            'listKegiatan' => $this->RelationTable->getKegiatanByIdKom(session()->get('komunitas')),
            'isEdit' => false
        ];
        return view('admin/kegiatan', $data);
    }

    public function save()
    {
        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $tanggal = $this->request->getPost('tanggal');
        $thumbnail = $this->request->getFile('thumbnail');
        // dd([
        //     'idKomunitas' => session()->get('komunitas'),
        //     'judul' =>  $judul,
        //     'deskripsi' =>  $deskripsi,
        //     'tanggal' =>  $tanggal,
        //     // 'thumbnail' => $newName
        // ]);
        if (!$this->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'thumbnail' => ['uploaded[thumbnail]']
        ])) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/kegiatan')->withInput();
        }

        $newName = '';

        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $newName = 'thumbnail-' . $thumbnail->getRandomName();
            $thumbnail->move($this->GaleriPath, $newName);
        }

        $this->KegiatanModel->insert([
            'idKomunitas' => session()->get('komunitas'),
            'judul' =>  $judul,
            'deskripsi' =>  $deskripsi,
            'tanggal' =>  $tanggal,
            'thumbnail' => $newName
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan !');
        return redirect()->to('admin/kegiatan');
    }

    public function editPage($id)
    {
        $data = [
            'judul' => 'Kegiatan Komunitas',
            'kegiatan' => $this->dataKegiatan,
            'validation' => \Config\Services::validation(),
            'listKegiatan' => $this->RelationTable->getKegiatanByIdKom(session()->get('komunitas')),
            'dataEdit' => $this->KegiatanModel->find($id),
            'isEdit' => true
        ];
        return view('admin/kegiatan', $data);
    }

    public function update($id)
    {
        $judul = $this->request->getPost('judul');
        $deskripsi = $this->request->getPost('deskripsi');
        $tanggal = $this->request->getPost('tanggal');
        $thumbnail = $this->request->getFile('thumbnail');
        $newName = '';

        if (!$this->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',

        ])) {
            session()->setFlashdata('msg-danger', 'Data gagal diubah!!!');
            return redirect()->to('admin/kegiatan/edit/' . $id)->withInput();
        }

        if ($thumbnail->getName() == '') {
            $newName = $this->KegiatanModel->find($id)['thumbnail'];
        }

        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $newName = 'thumbnail-' . $thumbnail->getRandomName();
            $thumbnail->move($this->GaleriPath, $newName);
        }

        $this->KegiatanModel->update($id, [
            'judul' =>  $judul,
            'deskripsi' =>  $deskripsi,
            'tanggal' =>  $tanggal,
            'thumbnail' => $newName
        ]);

        session()->setFlashdata('msg-success', 'Data berhasil diubah !');
        return redirect()->to('admin/kegiatan');
    }

    public function delete($id)
    {
        // dd($id);
        $this->KegiatanModel->delete($id);
        $this->GaleriModel->where('idKegiatan', $id)->delete();
        session()->setFlashdata('msg-success', 'Data berhasil dihapus !');
        return redirect()->to('admin/kegiatan');
    }

    // Galeri
    public function galeriPage($idKegiatan)
    {
        $data = [
            'judul' => 'Kegiatan Komunitas',
            'idKegiatan' => $idKegiatan,
            'listGaleri' => $this->GaleriModel->where('idKegiatan', $idKegiatan)->findAll()
        ];
        return view('admin/galeri', $data);
    }

    public function saveGaleri($idKegiatan)
    {
        if (!$this->validate([
            'foto' => [
                'uploaded[foto]',
            ],
        ])) {
            session()->setFlashdata('msg-danger', 'Data gagal ditambahkan!!!');
            return redirect()->to('admin/galeri/' . $idKegiatan)->withInput();
        }

        if ($foto = $this->request->getFiles()) {
            foreach ($foto['foto'] as $foto) {
                if ($foto->isValid() && !$foto->hasMoved()) {
                    $newName = $foto->getRandomName();
                    $foto->move($this->GaleriPath, $newName);
                    $this->GaleriModel->insert([
                        'idKegiatan' =>  $idKegiatan,
                        'foto' =>  $newName,
                    ]);
                }
            }
        }
        session()->setFlashdata('msg-success', 'Data berhasil ditambahkan !');
        return redirect()->to('admin/galeri/' . $idKegiatan);
    }

    public function deleteGaleri($idKegiatan, $idGaleri)
    {
        $this->GaleriModel->delete($idGaleri);
        session()->setFlashdata('msg-success', 'Data berhasil dihapus!');
        return redirect()->to('admin/galeri/' . $idKegiatan);
    }
}
