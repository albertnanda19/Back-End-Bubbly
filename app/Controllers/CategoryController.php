<?php

namespace App\Controllers;

use App\Repositories\CategoryRepository;
use CodeIgniter\RESTful\ResourceController;

class CategoryController extends ResourceController
{
    protected $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        
        return createResponse(200, 'Berhasil mendapatkan daftar kategori produk', $categories);
    }
}