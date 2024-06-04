<?php

namespace App\Interfaces;

interface RoleRepositoryInterface
{
    public function find($id);
    public function findAll();
    public function insert(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByName($name);
}