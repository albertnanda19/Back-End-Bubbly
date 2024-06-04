<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function find($id);

    public function findAll();

    public function insert(array $data);

    public function update($id, array $data);

    public function delete($id);
}