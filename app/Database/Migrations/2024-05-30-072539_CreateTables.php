<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        $this->db->query('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        $this->db->query("
            CREATE TABLE roles (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                name VARCHAR(255) NOT NULL
            );
        ");

        $this->db->query("
            CREATE TABLE users (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                username VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                no_telp VARCHAR(15) DEFAULT '',
                address TEXT DEFAULT '',
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                role_id UUID,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE ON UPDATE CASCADE
            );
        ");

        $this->db->query("
            CREATE OR REPLACE FUNCTION update_updated_at_column()
            RETURNS TRIGGER AS $$
            BEGIN
                NEW.updated_at = CURRENT_TIMESTAMP;
                RETURN NEW;
            END;
            $$ language 'plpgsql';
        ");

        $this->db->query("
            CREATE TRIGGER update_users_updated_at
            BEFORE UPDATE ON users
            FOR EACH ROW
            EXECUTE FUNCTION update_updated_at_column();
        ");

        $this->db->query("
            CREATE TABLE stores (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                id_seller UUID,
                name VARCHAR(255) NOT NULL,
                logo VARCHAR(255) DEFAULT '',
                description TEXT DEFAULT '',
                contact VARCHAR(255) DEFAULT '',
                open_time TIME,
                close_time TIME,
                likes INT DEFAULT 0,
                followers INT DEFAULT 0,
                address TEXT NOT NULL,
                google_maps_src TEXT,
                CONSTRAINT fk_id_seller FOREIGN KEY (id_seller) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
            );
        ");

        $this->db->query("
            CREATE TABLE categories (
                id UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
                name VARCHAR(255) NOT NULL
            );
        ");

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
                CONSTRAINT fk_store_id FOREIGN KEY (store_id) REFERENCES stores(id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT fk_seller_id FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT fk_category_id FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE
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

        $this->db->query("DROP TRIGGER IF EXISTS update_users_updated_at ON users;");
        $this->db->query("DROP FUNCTION IF EXISTS update_updated_at_column();");
    }
}