<?php

namespace App\Repositories;

use App\Models\StoreModel;
use App\Models\ProductModel;
use App\Models\UserModel;

class StoreRepository extends BaseRepository
{
    protected $storeModel;
    protected $productModel;
    protected $userModel;

    public function __construct()
    {
        $this->storeModel = new StoreModel();
        $this->productModel = new ProductModel();
        $this->userModel = new UserModel();
    }

    public function findByIdWithProducts($id)
    {
        $store = $this->storeModel->select(
            'stores.id, stores.name, stores.logo, stores.address, stores.followers, stores.likes, 
            users.id as seller_id, users.name as seller_name'
        )
        ->join('users', 'users.id = stores.id_seller', 'left')
        ->where('stores.id', $id)
        ->first();

        if (!$store) {
            return null;
        }

        $products = $this->productModel->select(
            'products.id as product_id, products.name as product_name, products.price, products.images as product_image'
        )
        ->where('products.store_id', $id)
        ->findAll();

        $store['products'] = $products;

        return $store;
    }

    public function getAllStores()
    {
        return $this->storeModel->select(
            'stores.id, stores.name, stores.logo, stores.address, users.name as seller_name'
        )
        ->join('users', 'users.id = stores.id_seller', 'left')
        ->findAll();
    }
}