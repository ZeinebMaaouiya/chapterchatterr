<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAuthorsTable extends Migration
{
    public function up()
    {
        // Add new fields to the 'authors' table
        $fields = [
            'profile_picture' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'birthdate' => [
                'type' => 'DATE',
                'null' => true
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Male', 'Female', 'Other'],
                'null' => true
            ]
        ];

        // Add new columns to the authors table
        $this->forge->addColumn('authors', $fields);
    }

    public function down()
    {
        // Remove the added fields from the 'authors' table
        $this->forge->dropColumn('authors', ['profile_picture', 'birthdate', 'age', 'gender']);
    }
}

