<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{

  protected $table      = 'suratKeluar';
  protected $primaryKey = 'id';

  protected $useAutoIncrement = true;

  protected $returnType     = 'array';
  protected $allowedFields = ['nomorSurat', 'tanggalSurat', 'tanggalKirim', 'tujuan', 'perihal', 'file', 'idKomunitas'];
}
