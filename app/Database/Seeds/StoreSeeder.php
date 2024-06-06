<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run()
    {
        $sellerIds = $this->db->table('users')->whereIn('username', ['seller1', 'seller2', 'seller3'])->get()->getResultArray();

        $data = [
            [
                'id_seller' => $sellerIds[0]['id'],
                'name' => 'Cassie Bakery',
                'logo' => 'cassie_bakery_logo.png',
                'description' => 'Toko kue terbaik',
                'contact' => '081229941540',
                'open_time' => '09:00:00',
                'close_time' => '18:00:00',
                'likes' => 100,
                'followers' => 0, 
                'address' => 'Alamat Toko 1',
            ],
            [
                'id_seller' => $sellerIds[1]['id'],
                'name' => 'Viels Design Studio',
                'logo' => 'viels-image.jpg',
                'description' => 'Digital artist Viel menyediakan berbagai jasa desain 2D custom mulai dari desain illustrasi karakter sampai desain logo perusahaan. Pelanggan bisa diskusi harga sesuai dengan tingkat kerincian detil desain yang diminta',
                'contact' => '081257425018',
                'open_time' => '10:00:00',
                'close_time' => '19:00:00',
                'likes' => 150,
                'followers' => 0, 
                'address' => 'Alamat Toko 2',
            ],
            [
                'id_seller' => $sellerIds[2]['id'],
                'name' => 'Syellys Cake and Bakery',
                'logo' => 'shop-profile-syelly.png',
                'description' => 'Every cake have a different story, just like memories❤️',
                'contact' => '0822711100321',
                'open_time' => '08:00:00',
                'close_time' => '17:00:00',
                'likes' => 200,
                'followers' => 0, 
                'address' => 'Alamat Toko 3',
            ]
        ];

        $this->db->table('stores')->insertBatch($data);
    }
}