<?php

namespace App\Models;

use CodeIgniter\Database\BaseBuilder;
use Config\Database;

class RelationTable
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getArsip()
    {
        return $this->db->table('arsipKomunitas')
            ->select('arsipKomunitas.*, komunitas.nama AS namaKomunitas')
            ->join('komunitas', 'komunitas.id = arsipKomunitas.idKomunitas')
            ->get()
            ->getResultArray();
    }

    public function getKegiatan()
    {
        return $this->db->table('kegiatan')->select('kegiatan.*, komunitas.nama')
            ->join('komunitas', 'komunitas.id = kegiatan.idKomunitas')
            ->get()->getResultArray();
    }
    public function getHasilBelajar()
    {
        return $this->db->table('anggota')->select('anggota.*')
            ->join('hasilBelajar', 'anggota.id = hasilBelajar.idAnggota')
            ->get()->getResultArray();
    }

    public function checkAdminExists($idKomunitas)
    {
        return $this->db->table('anggota')
            ->join('penugasan', 'penugasan.idAnggota = anggota.id')
            ->join('komunitas', 'komunitas.id = penugasan.idKomunitas')
            ->where('idKomunitas', $idKomunitas)
            ->where('penugasan.status', 'Y')
            ->where('penugasan.role', 'admin')
            ->get()->getRowArray();
    }

    public function listKerasulan()
    {
        return $this->db->table('kerasulan')
            ->select('kerasulan.*, jenisKerasulan.nama AS namaJenisKerasulan, komunitas.nama as namaKomunitas')
            ->join('jenisKerasulan', 'jenisKerasulan.id = kerasulan.idJenisKerasulan')
            ->join('komunitas', 'komunitas.id = kerasulan.idKomunitas')
            ->get()->getResultArray();
    }



    public function listKerasulanByKomunitas($id)
    {
        return $this->db->table('kerasulan')
            ->select('kerasulan.*, jenisKerasulan.nama AS namaJenisKerasulan, komunitas.nama as namaKomunitas')
            ->join('jenisKerasulan', 'jenisKerasulan.id = kerasulan.idJenisKerasulan')
            ->join('komunitas', 'komunitas.id = kerasulan.idKomunitas')
            ->where('idKomunitas', $id)
            ->get()->getResultArray();
    }

    public function listKegiatan()
    {
        return $this->db->table('kegiatan')->select('kegiatan.*, komunitas.nama AS namaKomunitas , galeri.id AS idGaleri, galeri.foto')
            ->select('kegiatan.*, anggota.nama AS namaAnggota')
            ->join('komunitas', 'komunitas.id = kegiatan.idKomunitas')
            ->join('galeri', 'galeri.idKegiatan = kegiatan.id')
            ->get()->getResultArray();
    }

    public function listKegiatanNew()
    {
        return $this->db->table('kegiatan')->select('kegiatan.*, komunitas.nama AS namaKomunitas')
            ->join('komunitas', 'komunitas.id = kegiatan.idKomunitas')
            // ->join('galeri', 'galeri.idKegiatan = kegiatan.id')
            ->get()->getResultArray();
    }

    public function getKegiatanById($id)
    {
        return $this->db->table('kegiatan')->select('kegiatan.*, komunitas.nama AS namaKomunitas')
            ->join('komunitas', 'komunitas.id = kegiatan.idKomunitas')
            ->where('kegiatan.id', $id)
            ->get()->getRowArray();
    }

    public function getKegiatanByIdKom($id)
    {
        return $this->db->table('kegiatan')->select('kegiatan.*, komunitas.nama AS namaKomunitas')
            ->join('komunitas', 'komunitas.id = kegiatan.idKomunitas')
            ->where('komunitas.id', $id)
            ->get()->getResultArray();
    }


    public function getKegiatanByIdKomunitas($id)
    {
        return $this->db->query("SELECT kegiatan.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS max_tanggal
            FROM penugasan
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.max_tanggal = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        JOIN kegiatan ON kegiatan.idAnggota = a.id
        WHERE penugasan.idKomunitas = '$id'")->getResultArray();
    }

    public function getGaleriById($idKegiatan)
    {
        return $this->db->table('galeri')
            ->where('galeri.idKegiatan', $idKegiatan)
            ->get()->getResultArray();
    }

    public function latestKegiatan()
    {
        return $this->db->table('kegiatan')->select('kegiatan.*, komunitas.nama AS namaKomunitas')
            ->select('kegiatan.*, komunitas.nama AS namaAnggota')
            ->join('komunitas', 'komunitas.id = kegiatan.idKomunitas')
            // ->join('galeri', 'galeri.idKegiatan = kegiatan.id')
            ->orderBy('kegiatan.tanggal', 'DESC')
            ->get()->getRowArray();
    }

    public function getAnggota()
    {
        $subQuery = $this->db->table('penugasan')
            ->select('penugasan.idAnggota,penugasan.idKomunitas, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan')->groupBy('penugasan.idAnggota');

        return $this->db->newQuery()->select('p.*, komunitas.nama AS namaKomunitas, anggota.nama AS namaAnggota, anggota.nomorBaju, anggota.status, anggota.tempatLahir, anggota.tanggalLahir')->fromSubquery($subQuery, 'p')
            ->join('komunitas', 'p.idKomunitas = komunitas.id')
            ->join('anggota', 'p.idAnggota = anggota.id')
            ->get()->getResultArray();
    }

    public function getAnggotaByKomunitas($komunitas)
    {
        // $subQuery = $this->db->table('penugasan')
        //     ->select('penugasan.idAnggota,penugasan.idKomunitas, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan')->groupBy('penugasan.idAnggota');

        // return $this->db->newQuery()->select('p.*, komunitas.nama AS namaKomunitas, anggota.nama AS namaAnggota, anggota.nomorBaju, anggota.status, anggota.tempatLahir, anggota.tanggalLahir')->fromSubquery($subQuery, 'p')
        //     ->join('komunitas', 'p.idKomunitas = komunitas.id')
        //     ->join('anggota', 'p.idAnggota = anggota.id')
        //     ->where('penugasan.idKomunitas', $komunitas)
        //     ->get()->getResultArray();

        // penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, a.*

        // a.*, penugasan.idAnggota, penugasan.idKomunitas, p.max_tanggal
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE penugasan.idKomunitas = '$komunitas' AND penugasan.role = 'user'")->getResultArray();
    }

    public function getAnggotaByAnggota($idAnggota)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan where status = 'Y' and role = 'superadmin'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE penugasan.idAnggota = '$idAnggota'")->getRowArray();
    }

    public function getAnggotaAuth($idAnggota)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan where status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE penugasan.idAnggota = '$idAnggota'")->getRowArray();
    }

    public function getAnggotaAll()
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE penugasan.role = 'user'
        ")->getResultArray();
    }

    public function getAnggotaAllWithoutRole()
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        ")->getResultArray();
        // return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, penugasan.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, anggota.* FROM 
        // (SELECT penugasan.idAnggota,penugasan.idKomunitas,
        // MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan 
        // FROM penugasan WHERE STATUS = 'Y' OR (status NOT IN ('Y')) GROUP BY penugasan.idAnggota) AS P
        // JOIN penugasan USING (idAnggota, idKomunitas)
        // JOIN komunitas ON penugasan.idKomunitas = komunitas.id
        // JOIN anggota ON penugasan.idAnggota = anggota.id
        // ")->getResultArray();
    }

    public function getAnggotaAllWithoutRoleSuperAdmin()
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan where status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        ")->getResultArray();
    }

    function getRiwayatPemimpinProvinsi()
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan where status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE penugasan.role = 'superadmin' order by p.tanggalPenugasan DESC
        ")->getResultArray();
    }

    public function getAnggotaAllWithoutRoleStatusPenugasanAllSuperAdmin()
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        ")->getResultArray();
    }

    public function getAnggotaAllPengajuanSuperAdmin()
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan where status = 'T' OR 'M'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        ")->getResultArray();
    }

    public function checkSuperAdmin($role)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan where status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE penugasan.role = '$role'")->getRowArray();
    }


    public function getAnggotaByRoleAndKomunitas($idKomunitas)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, penugasan.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, anggota.* FROM 
        (SELECT penugasan.idAnggota,penugasan.idKomunitas,
        MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan 
        FROM penugasan WHERE STATUS = 'Y' OR (status NOT IN ('Y')) GROUP BY penugasan.idAnggota) AS P
        JOIN penugasan USING (idAnggota, idKomunitas)
        JOIN komunitas ON penugasan.idKomunitas = komunitas.id
        JOIN anggota ON penugasan.idAnggota = anggota.id
        WHERE penugasan.role = 'admin' and penugasan.idKomunitas = '$idKomunitas'
        ")->getRowArray();
    }

    public function getAnggotaByRoleKomunitas($idKomunitas, $role)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE komunitas.id = '$idKomunitas' AND penugasan.role = '$role'")->getRowArray();
    }

    public function getAnggotaByIdAnggota($idAnggota)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, penugasan.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, komunitas.nama AS namaKomunitas, anggota.* FROM 
        (SELECT penugasan.idAnggota,penugasan.idKomunitas,
        MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan 
        FROM penugasan WHERE STATUS = 'Y' OR (status NOT IN ('Y')) GROUP BY penugasan.idAnggota) AS P
        JOIN penugasan USING (idAnggota, idKomunitas)
        JOIN komunitas ON penugasan.idKomunitas = komunitas.id
        JOIN anggota ON penugasan.idAnggota = anggota.id
        WHERE anggota.id = '$idAnggota'
        ")->getRowArray();
    }

    public function riwayatPenugasan()
    {
        return $this->db->table('penugasan')
            ->select('penugasan.*, komunitas.nama')
            ->join('komunitas', 'komunitas.id = penugasan.idKomunitas')
            ->get()->getResultArray();
    }

    public function tahapPembinaan()
    {
        return $this->db->table('pembinaan')
            ->select('pembinaan.*, tahapPembinaan.nama')
            ->join('tahapPembinaan', 'tahapPembinaan.id = pembinaan.idTahapPembinaan')
            ->get()->getResultArray();
    }

    public function listPembinaanByAnggota($idAnggota)
    {
        return $this->db->table('pembinaan')
            ->select('pembinaan.*, tahapPembinaan.nama')
            ->join('tahapPembinaan', 'tahapPembinaan.id = pembinaan.idTahapPembinaan')
            ->orderBy('tanggalPembinaan', 'DESC')
            ->where('pembinaan.idAnggota', $idAnggota)
            ->get()->getResultArray();
    }

    public function getAnggotaPembinaan()
    {
        return $this->db->table('pembinaan')
            ->select('anggota.*, pembinaan.idTahapPembinaan')
            ->distinct(true)
            ->join('tahapPembinaan', 'tahapPembinaan.id = pembinaan.idTahapPembinaan')
            ->join('anggota', 'pembinaan.idAnggota = anggota.id')
            ->orderBy('pembinaan.tanggalPembinaan', 'Desc')
            ->where('pembinaan.status', 'Y')
            ->get()->getResultArray();
    }

    public function getAnggotaPenugasan()
    {
        return $this->db->table('penugasan')
            ->select('anggota.*, penugasan.idKomunitas', 'penugasan.tanggalPenugasan')
            ->distinct(true)
            ->join('komunitas', 'komunitas.id = penugasan.idKomunitas')
            ->join('anggota', 'penugasan.idAnggota = anggota.id')
            ->orderBy('penugasan.tanggalPenugasan', 'Desc')
            ->groupBy('anggota.id')
            ->where('penugasan.status', 'Y')
            ->get()->getResultArray();
    }

    function getAnggotaPenugasanByKomunitas($idKomunitas)
    {
        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE komunitas.id = '$idKomunitas'")->getResultArray();
    }

    function getAnggotaPembinaanByidPembinaan($idPembinaan)
    {
        return $this->db->query("SELECT pembinaan.idTahapPembinaan, pembinaan.idAnggota, p.tanggalPembinaan, pembinaan.keterangan, pembinaan.status AS statusPembinaan, tahapPembinaan.nama AS namaTahapPembinaan, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(pembinaan.tanggalPembinaan) AS tanggalPembinaan
            FROM pembinaan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN pembinaan ON pembinaan.idAnggota = a.id AND p.tanggalPembinaan = pembinaan.tanggalPembinaan
        JOIN tahapPembinaan ON tahapPembinaan.id = pembinaan.idTahapPembinaan
        JOIN (
            SELECT idAnggota, idKomunitas, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) pen ON pen.idAnggota = a.id
        JOIN komunitas ON komunitas.id = pen.idKomunitas
        WHERE tahapPembinaan.id = '$idPembinaan'")->getResultArray();
    }

    public function dataAnggota($komunitas, $status)
    {

        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE komunitas.id = '$komunitas' and a.status = '$status'")->getResultArray();
    }
    public function dataAnggotaAll($status)
    {

        return $this->db->query("SELECT penugasan.idKomunitas, penugasan.idAnggota, p.tanggalPenugasan, penugasan.keterangan, penugasan.status AS statusPenugasan, penugasan.role, komunitas.nama AS namaKomunitas, a.*
        FROM anggota a
        JOIN (
            SELECT idAnggota, MAX(penugasan.tanggalPenugasan) AS tanggalPenugasan
            FROM penugasan WHERE status = 'Y'
            GROUP BY idAnggota
        ) p ON a.id = p.idAnggota
        JOIN penugasan ON penugasan.idAnggota = a.id AND p.tanggalPenugasan = penugasan.tanggalPenugasan
        JOIN komunitas ON komunitas.id = penugasan.idKomunitas
        WHERE a.status = '$status'")->getResultArray();
    }

    public function getAnggotaById($idAnggota)
    {
        return $this->db->table('penugasan penA')
            ->select('anggota.*, penA.idAnggota, penA.idKomunitas, penA.tanggalPenugasan, penA.keterangan AS keteranganPenugasan, penA.status AS statusPenugasan, komunitas.nama AS namaKomunitas, pemA.idAnggota, pemA.idTahapPembinaan, pemA.tanggalPembinaan, tahapPembinaan.nama AS namaPembinaan, pemA.keterangan AS keteranganPembinaan, pemA.tanggalPembinaan, pemA.keterangan AS keteranganPembinaan')
            ->join('anggota', 'anggota.id = penA.idAnggota')
            ->join('komunitas', 'komunitas.id = penA.idKomunitas')
            ->join('pembinaan pemA', 'pemA.idAnggota = anggota.id')
            ->join('tahapPembinaan', 'tahappembinaan.id = pemA.idTahapPembinaan')
            ->where('penA.tanggalPenugasan = (SELECT MAX(tanggalPenugasan) FROM penugasan as penB where penA.idAnggota = penB.idAnggota)')
            ->where('pemA.tanggalPembinaan = (SELECT MAX(tanggalPembinaan) FROM pembinaan as pemB where pemA.idAnggota = pemB.idAnggota)')
            ->where('penA.idAnggota', $idAnggota)
            ->get()->getRowArray();
    }

    public function getPenugasan()
    {
        return $this->db->table('penugasan')
            ->join('komunitas', 'komunitas.id = penugasan.idKomunitas')
            ->get()->getResultArray();
    }

    public function getProvinsiByIdKomunitas($idKomunitas)
    {
        return $this->db->table('provinsi')->select('provinsi.id, provinsi.nama')
            ->join('komunitas', 'komunitas.idProvinsi = provinsi.id')
            ->where('komunitas.id', $idKomunitas)
            ->get()->getRowArray();
    }

    public function listPenugasanByAnggota($idAnggota)
    {
        return $this->db->table('penugasan')
            ->select('penugasan.*, komunitas.nama')
            ->join('komunitas', 'komunitas.id = penugasan.idKomunitas')
            ->where('penugasan.idAnggota', $idAnggota)
            ->orderBy('tanggalPenugasan', 'DESC')
            ->get()->getResultArray();
    }


    public function insertPenugasan($data)
    {
        return $this->db->table('penugasan')->set($data)->insert();
    }

    public function deletePenugasan($id)
    {
        return $this->db->table('penugasan')->delete(['id' => $id]);
    }
}
