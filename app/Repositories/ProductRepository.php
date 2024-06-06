<?php

namespace App\Repositories;

use App\Models\ProductModel;

class ProductRepository extends BaseRepository
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function getAllProducts($categoryId = null)
    {
        $builder = $this->productModel->select(
            'products.id, products.name as product_name, products.price, products.deskripsi as description, products.likes, 
            categories.name as category, stores.name as store_name, products.images as image'
        )
        ->join('categories', 'categories.id = products.category_id', 'left')
        ->join('stores', 'stores.id = products.store_id', 'left');

        if ($categoryId) {
            $builder->where('products.category_id', $categoryId);
        }

        $products = $builder->findAll();

        foreach ($products as &$product) {
            $product['price'] = (int)$product['price'];
            $product['likes'] = (int)$product['likes'];
        }

        return $products;
    }
}