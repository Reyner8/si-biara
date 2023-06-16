<?php

namespace App\Models;

use CodeIgniter\Model;

class TahapPembinaan extends Model
{
    protected $table      = 'tahapPembinaan';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['nama', 'keterangan'];
}
