<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTypeToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'type' => [
                'type' => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default' => 'user',
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'type');
    }
}
