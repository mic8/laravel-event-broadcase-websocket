<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->all();
    }
}