<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table      = 'Kegiatan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['idAnggota', 'judul', 'deskripsi', 'tanggal', 'thumbnail'];
}
