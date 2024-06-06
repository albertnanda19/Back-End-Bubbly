<?php

namespace App\Repositories;

use App\Models\CategoryModel;

class CategoryRepository extends BaseRepository
{
    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function getAllCategories()
    {
        return $this->categoryModel->select('id, name as nama_kategori')->findAll();
    }
}