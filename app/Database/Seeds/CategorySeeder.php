<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Electronics'],
            ['name' => 'Clothing'],
            ['name' => 'Books']
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}