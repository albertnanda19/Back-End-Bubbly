<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserSeeder extends Seeder
{
    public function run()
    {
        $rolesData = [
            'buyer' => [
                [
                    'username' => 'buyer1',
                    'name' => 'Buyer One',
                    'no_telp' => '1234567890',
                    'address' => 'Buyer Address 1',
                    'email' => 'buyer1@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
                [
                    'username' => 'buyer2',
                    'name' => 'Buyer Two',
                    'no_telp' => '0987654321',
                    'address' => 'Buyer Address 2',
                    'email' => 'buyer2@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
                [
                    'username' => 'buyer3',
                    'name' => 'Buyer Three',
                    'no_telp' => '1357924680',
                    'address' => 'Buyer Address 3',
                    'email' => 'buyer3@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
            ],
            'seller' => [
                [
                    'username' => 'seller1',
                    'name' => 'Seller One',
                    'no_telp' => '9876543210',
                    'address' => 'Seller Address 1',
                    'email' => 'seller1@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
                [
                    'username' => 'seller2',
                    'name' => 'Seller Two',
                    'no_telp' => '0123456789',
                    'address' => 'Seller Address 2',
                    'email' => 'seller2@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
                [
                    'username' => 'seller3',
                    'name' => 'Seller Three',
                    'no_telp' => '2468013579',
                    'address' => 'Seller Address 3',
                    'email' => 'seller3@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
            ],
            'admin' => [
                [
                    'username' => 'admin1',
                    'name' => 'Admin One',
                    'no_telp' => '1122334455',
                    'address' => 'Admin Address 1',
                    'email' => 'admin1@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
                [
                    'username' => 'admin2',
                    'name' => 'Admin Two',
                    'no_telp' => '9988776655',
                    'address' => 'Admin Address 2',
                    'email' => 'admin2@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
                [
                    'username' => 'admin3',
                    'name' => 'Admin Three',
                    'no_telp' => '5566778899',
                    'address' => 'Admin Address 3',
                    'email' => 'admin3@example.com',
                    'password' => password_hash('password123', PASSWORD_DEFAULT), 
                ],
            ],
        ];

        foreach ($rolesData as $roleName => $users) {
            foreach ($users as $userData) {
                $userData['role_id'] = $this->getRoleId($roleName);
                $userData['created_at'] = Time::now();
                $userData['updated_at'] = Time::now();

                $this->db->table('users')->insert($userData);
            }
        }
    }

    private function getRoleId($roleName)
    {
        return $this->db->table('roles')->where('name', $roleName)->get()->getRow()->id;
    }
}
