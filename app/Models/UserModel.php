<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 'name', 'no_telp', 'address', 'email', 'password', 'role_id', 'created_at', 'updated_at'
    ];
    protected $returnType = 'array';
    protected $useTimestamps = true;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
