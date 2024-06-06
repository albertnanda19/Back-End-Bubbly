<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $allowedFields = [
        'id', 'store_id', 'seller_id', 'name', 'price', 'deskripsi', 'category_id', 'likes', 'created_at', 'updated_at'
    ];
}
