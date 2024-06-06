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
        $categoryId = $this->request->getGet('category_id');
        $products = $this->productRepository->getAllProducts($categoryId);

        foreach ($products as &$product) {
            $product['likes'] = (int)$product['likes'];
        }

        return createResponse(200, 'Berhasil mendapatkan daftar produk', $products);
    }
}