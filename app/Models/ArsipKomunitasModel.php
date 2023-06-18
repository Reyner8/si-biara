<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipKomunitasModel extends Model
{
    protected $table      = 'arsipKomunitas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['idKomunitas', 'nama', 'tanggal', 'jenisFile', 'file'];
}
