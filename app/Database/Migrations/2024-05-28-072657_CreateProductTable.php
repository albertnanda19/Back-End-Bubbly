<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'store_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'seller_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'price' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => false,
            ],
            'deskripsi' => [
                'type'           => 'TEXT',
                'null'           => true,
            ],
            'category_id' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => false,
            ],
            'likes' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
            ],
            'created_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
            'updated_at' => [
                'type'           => 'TIMESTAMP',
                'null'           => true,
            ],
        ]);

        // Define primary key
        $this->forge->addKey('id', true);

        // Create the table
        $this->forge->createTable('product');
    }

    public function down()
    {
        // Drop the table if it exists
        $this->forge->dropTable('product');
    }
}
