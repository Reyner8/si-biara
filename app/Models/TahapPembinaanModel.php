<?php

namespace App\Models;

use CodeIgniter\Model;


class TahapPembinaanModel extends Model
{

    protected $table = 'tahapPembinaan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['keterangan'];
}
