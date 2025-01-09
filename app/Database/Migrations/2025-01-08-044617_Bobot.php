<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bobot extends Migration
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
            'selisih' => [
                'type'       => 'DOUBLE',
            ],
            'nilai' => [
                'type'       => 'DOUBLE',
            ],
            'keterangan' => [
                'type'       => 'TEXT',
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
        $this->forge->createTable('bobot'); // Nama tabel singular
    }

    public function down()
    {
        $this->forge->dropTable('bobot');
    }
}