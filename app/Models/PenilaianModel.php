<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table      = 'penilaian';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['alternative_id','sub_kriteria_id'];

    public function getWithAlternatifAndSubKriteria()
    {
        return $this->select('penilaian.*, 
                          alternative.nama_alternative, 
                          sub_kriteria.nama_subkriteria, 
                          sub_kriteria.nilai, 
                          kriteria.id,
                          kriteria.nama_kriteria') // Tambahkan nama_kriteria
                ->join('alternative', 'alternative.id = penilaian.alternative_id', 'left')
                ->join('sub_kriteria', 'sub_kriteria.id = penilaian.sub_kriteria_id', 'left')
                ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id', 'left') // Join ke tabel kriteria
                ->findAll();
    }

    public function getPenilaianWithAlternative($id){
        return $this->select('penilaian.*, 
                                alternative.nama_alternative, 
                                sub_kriteria.nama_subkriteria, 
                                sub_kriteria.nilai, 
                                kriteria.id,
                                kriteria.nama_kriteria') // Tambahkan nama_kriteria
                        ->join('alternative', 'alternative.id = penilaian.alternative_id', 'left')
                        ->join('sub_kriteria', 'sub_kriteria.id = penilaian.sub_kriteria_id', 'left')
                        ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id', 'left') // Join ke tabel kriteria
                        ->where('alternative.id', $id)
                        ->findAll();
    }

}