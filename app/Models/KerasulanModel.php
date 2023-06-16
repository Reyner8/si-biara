<?php

namespace App\Models;

use CodeIgniter\Model;

class KerasulanModel extends Model
{

  protected $table      = 'kerasulan';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $allowedFields = ['idKomunitas', 'idJenisKerasulan', 'namaLembaga', 'tanggalBerdiri', 'keterangan', 'foto'];
}
