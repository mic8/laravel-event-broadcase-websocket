<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all();

    public function create(array $params);

    public function find($id);

    public function delete($id);

    public function update($id, array $params);
}