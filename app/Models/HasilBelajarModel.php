<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilBelajarModel extends Model
{
    protected $table      = 'hasilBelajar';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['idAnggota', 'universitas', 'fakultas', 'prodi', 'jenjang', 'file'];
}
