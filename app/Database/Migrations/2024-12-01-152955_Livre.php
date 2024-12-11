<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Livre extends Migration
{
    public function up()
    {
        // Create 'livre' table
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
            'author_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
           
            'summary' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'pages' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'published_date' => [
                'type' => 'DATE',
                'null' => true
            ],
            'format' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'isbn' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'unique' => true
            ],
            'asin' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'language' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'cover_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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

        // Add primary key
        $this->forge->addKey('id', true);

        // Add foreign key constraints
        $this->forge->addForeignKey('author_id', 'authors', 'id', 'CASCADE', 'CASCADE');

        // Create the 'livre' table
        $this->forge->createTable('livre');
    }

    public function down()
    {
        // Drop 'livre' table
        $this->forge->dropTable('livre');
    }
}
