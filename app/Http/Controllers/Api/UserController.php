<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\User\UserStoreRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()->json($this->userRepository->all());
    }

    public function store(UserStoreRequest $request)
    {
        $params = $request->all();
        $params['password'] = bcrypt($request->input('password'));

        $user = $this->userRepository->create($params);

        return response()->json(['success' => true, 'message' => 'Success create user', 'user' => $user], 200);
    }
}