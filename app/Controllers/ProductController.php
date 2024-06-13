<?php

namespace App\Controllers;

use App\Repositories\ProductRepository;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends ResourceController
{
    protected $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function index()
    {
        $categoryId = $this->request->getGet('category');

        $products = $this->productRepository->getAllProducts($categoryId);

        return createResponse(200, 'Berhasil mendapatkan daftar produk', $products);
    }

    public function showCertainProduct($id)
    {
        $product = $this->productRepository->findById($id);

        if (!$product) {
            return createResponse(404, 'Produk tidak ditemukan', null);
        }

        $productData = [
            'id' => $product['id'],
            'name' => $product['product_name'],
            'price' => (int)$product['price'],
            'store_name' => $product['store_name'],
            'image_url' => $product['image'],
            'contact' => $product['contact'],
            'product_description' => $product['description'],
            'store_description' => $product['store_description'],
            'google_maps_src' => $product['google_maps_src']
        ];

        return createResponse(200, 'Berhasil mendapatkan data produk', $productData);
    }
}