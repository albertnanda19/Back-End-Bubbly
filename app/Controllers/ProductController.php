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
}