<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table      = 'anggota';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['nama', 'nomorBaju', 'password', 'status', 'tempatLahir', 'tanggalLahir', 'nomorTelepon', 'status', 'foto', 'berkasTerkait', 'meninggal'];
}
