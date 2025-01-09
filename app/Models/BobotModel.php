<?php

namespace App\Models;

use CodeIgniter\Model;

class BobotModel extends Model
{
    protected $table      = 'bobot';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['selisih', 'nilai', 'keterangan'];

    public function bobotNilaiWithSelisih($selisih){
        return $this->select('bobot.*')
                        ->where('bobot.selisih', $selisih)
                        ->first();;
    }
}