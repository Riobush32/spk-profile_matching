<?php

namespace App\Database\Seeds;

use Faker\Factory;
use CodeIgniter\I18n\Time;
use CodeIgniter\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    public function run()
    {
        // Membuat objek Faker
        $faker = Factory::create('id_ID');

        // Menyiapkan data menggunakan Faker
        $data = [];
        for ($i = 0; $i < 5; $i++) { // Membuat 10 data palsu
            $data[] = [
                'nama_kriteria'  => $faker->word,               // Nama acak
                'jenis_kriteria' => $faker->randomElement(['Core Factor', 'Secondary Factor']),  // Jenis kriteria acak
                'created_at'     => Time::now(),
                'updated_at'     => Time::now(),
            ];
        }

 
        $this->db->table('kriteria')->insertBatch($data);
    }
}