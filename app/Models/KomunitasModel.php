<?php

namespace App\Models;

use CodeIgniter\Model;


class KomunitasModel extends Model
{

    protected $table = 'komunitas';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['nama', 'alamat', 'tanggalBerdiri'];
}
