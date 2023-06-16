<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table      = 'galeri';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['idKegiatan', 'foto'];
}
