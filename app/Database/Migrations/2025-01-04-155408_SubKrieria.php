<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubKriteria extends Migration
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
            'kriteria_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_subkriteria' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'nilai' => [
                'type'       => 'DOUBLE',
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kriteria_id', 'kriteria', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('sub_kriteria');
    }

    public function down()
    {
        $this->forge->dropTable('sub_kriteria');
    }
}