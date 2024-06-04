<?php

namespace Config;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function userRepository($getShared = true): UserRepositoryInterface
    {
        if ($getShared) {
            return static::getSharedInstance('userRepository');
        }

        return new UserRepository();
    }

    public static function roleRepository($getShared = true): RoleRepositoryInterface
    {
        if ($getShared) {
            return static::getSharedInstance('roleRepository');
        }

        return new RoleRepository();
    }
}