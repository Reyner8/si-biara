<?php

namespace App\Models;

use CodeIgniter\Model;

class PenugasanModel extends Model
{
    protected $table      = 'penugasan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['idAnggota', 'idKomunitas', 'tanggalPenugasan', 'keterangan', 'status'];
}
