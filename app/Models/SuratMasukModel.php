<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{

  protected $table      = 'suratMasuk';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $allowedFields = ['nomorSurat', 'tanggalSurat', 'tanggalTerima', 'pengirim', 'perihal', 'file', 'idKomunitas'];
}
