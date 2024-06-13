<?php

namespace App\Controllers;

use App\Repositories\StoreRepository;
use CodeIgniter\RESTful\ResourceController;

class StoreController extends ResourceController
{
    protected $storeRepository;

    public function __construct()
    {
        $this->storeRepository = new StoreRepository();
    }

    public function showCertainStore($id)
    {
        $store = $this->storeRepository->findByIdWithProducts($id);

        if (!$store) {
            return createResponse(404, 'Toko tidak ditemukan', null);
        }

        $storeData = [
            'id' => $store['id'],
            'name' => $store['name'],
            'logo' => $store['logo'],
            'address' => $store['address'],
            'followers' => (int)$store['followers'],
            'likes' => (int)$store['likes'],
            'seller' => [
                'id' => $store['seller_id'],
                'name' => $store['seller_name'],
            ],
            'products' => array_map(function($product) {
                return [
                    'id' => $product['product_id'],
                    'name' => $product['product_name'],
                    'price' => (int)$product['price'],
                    'image' => $product['product_image'],
                ];
            }, $store['products'])
        ];

        return createResponse(200, 'Berhasil mendapatkan data toko', $storeData);
    }
}