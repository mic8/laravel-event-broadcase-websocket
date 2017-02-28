<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Events\User\UserAdded;

use App\User;
use App\Http\Requests\User\UserStoreRequest;

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

    public function store(UserStoreRequest $request)
    {
        $params = $request->all();
        $params['password'] = bcrypt($request->input('password'));

        $created = $this->user->create($params);
        event(new UserAdded($created));

        return response()->json(['success' => true, 'message' => 'Success create user', 'user' => $created], 200);
    }
}