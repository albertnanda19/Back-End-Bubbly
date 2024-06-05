<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $categories = $this->db->table('categories')->get()->getResultArray();
        $stores = $this->db->table('stores')->get()->getResultArray();
        $sellers = $this->db->table('users')->whereIn('username', ['seller1', 'seller2', 'seller3'])->get()->getResultArray();

        $data = [];

        foreach ($categories as $category) {
            foreach ($stores as $store) {
                $data[] = [
                    'store_id' => $store['id'],
                    'seller_id' => $store['id_seller'],
                    'name' => 'Product 1 in ' . $category['name'],
                    'price' => 10000,
                    'deskripsi' => 'Description for Product 1 in ' . $category['name'],
                    'category_id' => $category['id'],
                    'likes' => 10,
                    'created_at' => Time::now(),
                    'updated_at' => Time::now()
                ];
                $data[] = [
                    'store_id' => $store['id'],
                    'seller_id' => $store['id_seller'],
                    'name' => 'Product 2 in ' . $category['name'],
                    'price' => 20000,
                    'deskripsi' => 'Description for Product 2 in ' . $category['name'],
                    'category_id' => $category['id'],
                    'likes' => 20,
                    'created_at' => Time::now(),
                    'updated_at' => Time::now()
                ];
                $data[] = [
                    'store_id' => $store['id'],
                    'seller_id' => $store['id_seller'],
                    'name' => 'Product 3 in ' . $category['name'],
                    'price' => 30000,
                    'deskripsi' => 'Description for Product 3 in ' . $category['name'],
                    'category_id' => $category['id'],
                    'likes' => 30,
                    'created_at' => Time::now(),
                    'updated_at' => Time::now()
                ];
            }
        }

        $this->db->table('products')->insertBatch($data);
    }
}