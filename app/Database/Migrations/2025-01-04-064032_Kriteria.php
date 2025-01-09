<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kriteria extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kriteria' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jenis_kriteria' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kriteria'); // Nama tabel singular
    }

    public function down()
    {
        $this->forge->dropTable('kriteria');
    }
}