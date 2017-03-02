<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\Post\PostStoreRequest;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    public $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return response()->json(['success' => true, 'data' => $this->postRepository->all()], 200);
    }

    public function store(PostStoreRequest $request)
    {
        $post = $this->postRepository->create($request->all());

        return response()->json(['success' => true, 'message' => 'Success create post', 'data' => $post]);
    }
}