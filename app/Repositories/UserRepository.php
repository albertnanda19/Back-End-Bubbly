<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository extends BaseRepository
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function findByUsername($username)
    {
        return $this->model->where('username', $username)->first();
    }

    public function findByEmail($email)
    {
        return $this->userModel->where('email', $email)->first();
    }
}
