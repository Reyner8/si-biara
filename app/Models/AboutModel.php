<?php

namespace App\Models;

use CodeIgniter\Model;

class AboutModel extends Model
{
    protected $table      = 'about';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $allowedFields = ['sejarah', 'visi', 'misi'];
}
