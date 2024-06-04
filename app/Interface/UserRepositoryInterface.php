<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function find($id);
    public function findAll();
    public function insert(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByUsername($username);
    public function findByEmail($email);
}