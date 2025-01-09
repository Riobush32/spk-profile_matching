<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class SubKriteriaSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('id_ID');

        // Menyiapkan data menggunakan Faker
        $data = [];
        for ($i = 0; $i < 25; $i++) { // Membuat 10 data palsu
            $data[] = [
                'kriteria_id'  => $faker->numberBetween(1, 5),               // Nama acak
                'nama_subkriteria' => $faker->word,  
                'nilai' => $faker->numberBetween(1, 5),
                'created_at'     => Time::now(),
                'updated_at'     => Time::now(),
            ];
        }

 
        $this->db->table('sub_kriteria')->insertBatch($data);
    }
}