<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StoreFollowerSeeder extends Seeder
{
    public function run()
    {
        $buyers = $this->db->table('users')->where('role_id', $this->getRoleId('buyer'))->get()->getResultArray();
        $stores = $this->db->table('stores')->get()->getResultArray();

        foreach ($stores as $store) {
            $followerCount = mt_rand(1, count($buyers)); 
            $selectedBuyers = array_rand($buyers, $followerCount);
            $data = [];

            foreach ((array)$selectedBuyers as $buyerIndex) {
                $data[] = [
                    'user_id' => $buyers[$buyerIndex]['id'],
                    'store_id' => $store['id']
                ];
            }

            $this->db->table('store_followers')->insertBatch($data);

            $this->db->table('stores')->where('id', $store['id'])->update(['followers' => $followerCount]);
        }
    }

    private function getRoleId($roleName)
    {
        return $this->db->table('roles')->where('name', $roleName)->get()->getRow()->id;
    }
}