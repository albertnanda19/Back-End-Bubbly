<?php

namespace App\Repositories;

use App\Models\RoleModel;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new RoleModel());
    }

    public function findByName($name)
    {
        return $this->model->where('name', $name)->first();
    }
}