<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
        ]);

        // Define primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('roles');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('roles');
    }
}
