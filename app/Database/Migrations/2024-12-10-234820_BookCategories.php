<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BookCategories extends Migration
{
    public function up()
    {
        // Create 'book_categories' pivot table
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'livre_id' => [ // Foreign key for books (livre table)
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'category_id' => [ // Foreign key for categories
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Add primary key
        $this->forge->addKey('id', true);

        // Add foreign key constraints
        $this->forge->addForeignKey('livre_id', 'livre', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');

        // Create the 'book_categories' table
        $this->forge->createTable('book_categories');
    }

    public function down()
    {
        // Drop 'book_categories' table
        $this->forge->dropTable('book_categories');
    }
}
