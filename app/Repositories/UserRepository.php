<?php

namespace App\Repositories;

use App\Models\UserModel;
use App\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        parent::__construct($this->userModel);
    }

    public function findByUsername($username)
    {
        return $this->userModel->where('username', $username)->first();
    }

    public function findByEmail($email)
    {
        return $this->userModel->where('email', $email)->first();
    }
}