<?php

namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{
    protected $table      = 'stores';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $allowedFields = [
        'id', 'id_seller', 'name', 'logo', 'description', 'contact', 'open_time', 'close_time', 'likes', 'followers'
    ];
}
