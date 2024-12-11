<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Authors extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'bio' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'nationality' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);

        $this->forge->createTable('authors');
    }

    public function down()
    {
        $this->forge->dropTable('authors');
    }
}
