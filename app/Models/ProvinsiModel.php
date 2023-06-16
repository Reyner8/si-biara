<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{

  protected $table      = 'provinsi';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $allowedFields = ['nama', 'visi', 'misi', 'sejarahSingkat'];
}
