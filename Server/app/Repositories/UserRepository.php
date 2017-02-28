<?php

namespace App\Repositories;

use App\Jobs\User\CreateUserJob;
use App\Events\User\UserAdded;

class UserRepository extends Repository
{
    protected $modelPath = 'App\User';

    public function create(array $params)
    {
        dispatch(new CreateUserJob($this->model, $params));
        $user = $this->model->all()->last();
        event(new UserAdded($user));

        return $user;
    }
}