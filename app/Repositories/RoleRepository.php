<?php

namespace App\Repositories;

use App\Models\RoleModel;

class RoleRepository extends BaseRepository
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
