<?php

namespace App\Models;

use CodeIgniter\Model;


class JenisKerasulanModel extends Model
{

    protected $table = 'jenisKerasulan';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['keterangan'];
}
