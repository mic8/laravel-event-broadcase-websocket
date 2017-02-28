<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;

class Repository implements RepositoryInterface
{
    protected $modelPath;

    protected $model;

    public function __construct()
    {
        $this->model = new $this->modelPath();
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $params)
    {
        return $this->model->create($params);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function update($id, array $params)
    {
        return $this->model->find($id)->fill($params)->save();
    }
}