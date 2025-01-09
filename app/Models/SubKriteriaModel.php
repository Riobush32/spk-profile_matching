<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $table      = 'sub_kriteria';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['kriteria_id','nama_subkriteria', 'nilai'];

    public function getWithKriteria()
    {
        return $this->select('sub_kriteria.*, kriteria.nama_kriteria, kriteria.jenis_kriteria')
            ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id', 'left')
            ->findAll();
    }
    public function getWithKriteriaById($id)
    {
        return $this->select('sub_kriteria.*, kriteria.nama_kriteria, kriteria.jenis_kriteria')
            ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id', 'left')
            ->where('sub_kriteria.id', $id)
            ->first();  // Mengambil hanya satu data
    }

    public function getAllWithKriteriaById($id)
    {
        return $this->select('sub_kriteria.*, kriteria.nama_kriteria')
            ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id', 'left')
            ->where('kriteria.id', $id)
            ->findAll();
    }
}