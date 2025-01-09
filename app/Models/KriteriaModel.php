<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'kriteria';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama_kriteria', 'jenis_kriteria'];
}