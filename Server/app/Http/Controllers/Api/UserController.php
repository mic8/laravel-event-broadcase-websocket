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
        return response()->json(['success' => true, 'data' => $this->userRepository->all()], 200);
    }

    public function store(UserStoreRequest $request)
    {
        $params = $request->all();
        $params['password'] = bcrypt($request->input('password'));

        $user = $this->userRepository->create($params);

        return response()->json(['success' => true, 'message' => 'Success create user', 'data' => $user], 200);
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return response()->json(['success' => true, 'message' => 'Success delete user'], 200);
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error delete user'], 500);
        }
    }
}