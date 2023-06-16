<?php

namespace App\Models;

use CodeIgniter\Model;

class PembinaanModel extends Model
{
    protected $table      = 'pembinaan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['idAnggota', 'idTahapPembinaan', 'tanggalPembinaan', 'keterangan', 'status'];
}
