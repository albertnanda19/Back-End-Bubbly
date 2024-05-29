<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStoreTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'id_seller' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'logo' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'description' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'contact' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
            ],
            'open_time' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'close_time' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'likes' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            'followers' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
        ]);

        // Define primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('store');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('store');
    }
}
