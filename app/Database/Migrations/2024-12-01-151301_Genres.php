<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Genres extends Migration
{
    public function up()
    {
        // Create 'genres' table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
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

        // Add primary key
        $this->forge->addKey('id', true);

        // Add unique constraint to 'name'
        $this->forge->addUniqueKey('name');

        // Create the table
        $this->forge->createTable('genres');
    }

    public function down()
    {
        // Drop 'genres' table
        $this->forge->dropTable('genres');
    }
}
