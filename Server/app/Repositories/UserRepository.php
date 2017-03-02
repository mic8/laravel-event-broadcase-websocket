<?php

namespace App\Repositories;

use App\Jobs\User\CreateUserJob;
use App\Events\User\UserAdded;

use App\Jobs\User\DeleteUserJob;
use App\Events\User\UserDeleted;

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

    public function delete($id)
    {
        $find = $this->model->find($id);

        dispatch(new DeleteUserJob($find));
        event(new UserDeleted($id));
    }
}