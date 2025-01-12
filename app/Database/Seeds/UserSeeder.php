<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Hash password
        $password = password_hash('password321', PASSWORD_BCRYPT);

        // Data user
        $data = [
            'username' => 'admin',
            'password' => $password, // Simpan password yang sudah di-hash
        ];

        // Insert data ke tabel 'users'
        $this->db->table('user')->insert($data);

        echo "User admin created with password: password321\n";
    }
}