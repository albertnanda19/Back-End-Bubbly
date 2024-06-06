<?php

namespace App\Repositories;

use App\Models\ProductModel;
use CodeIgniter\Database\BaseBuilder;

class ProductRepository extends BaseRepository
{
    protected $productModel;
    protected $db;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->db = \Config\Database::connect();
    }

    public function getAllProducts($categoryId = null)
    {
        $builder = $this->db->table('products p')
                            ->select('p.id, p.name as product_name, p.price, p.deskripsi as description, c.name as category, p.likes, s.name as store_name, p.images as image')
                            ->join('categories c', 'p.category_id = c.id')
                            ->join('stores s', 'p.store_id = s.id');

        if ($categoryId) {
            $builder->where('p.category_id', $categoryId);
        }

        return $builder->get()->getResultArray();
    }
}