<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Create Extension
        $this->db->query('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        // Create roles table
        $this->db->query("
            CREATE TABLE roles (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                name VARCHAR(255) NOT NULL
            );
        ");

        // Create users table
        $this->db->query("
            CREATE TABLE users (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                username VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                no_telp VARCHAR(15) NOT NULL,
                address TEXT NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                role_id UUID,
                FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE
            );
        ");

        // Create stores table
        $this->db->query("
            CREATE TABLE stores (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                id_seller UUID,
                name VARCHAR(255) NOT NULL,
                logo VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                contact VARCHAR(255) NOT NULL,
                open_time TIMESTAMP,
                close_time TIMESTAMP,
                likes INT DEFAULT 0,
                followers INT DEFAULT 0,
                FOREIGN KEY (id_seller) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
            );
        ");

        // Create categories table
        $this->db->query("
            CREATE TABLE categories (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                name VARCHAR(255) NOT NULL
            );
        ");

        // Create products table
        $this->db->query("
            CREATE TABLE products (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                store_id UUID,
                seller_id UUID,
                name VARCHAR(255) NOT NULL,
                price INT NOT NULL,
                deskripsi TEXT NOT NULL,
                category_id UUID,
                likes INT DEFAULT 0,
                created_at TIMESTAMP,
                updated_at TIMESTAMP,
                FOREIGN KEY (store_id) REFERENCES stores(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
            );
        ");
    }

    public function down()
    {
        $this->forge->dropTable('products');
        $this->forge->dropTable('categories');
        $this->forge->dropTable('stores');
        $this->forge->dropTable('users');
        $this->forge->dropTable('roles');
    }
}
