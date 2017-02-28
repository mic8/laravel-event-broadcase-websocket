<?php

namespace App\Repositories;

use App\Events\Post\PostAdded;
use App\Jobs\Post\CreatePostJob;

class PostRepository extends Repository
{
    protected $modelPath = 'App\Models\Post';

    public function create(array $params)
    {
        dispatch(new CreatePostJob($this->model, $params));
        $post = $this->all()->last();
        event(new PostAdded($post));

        return $post;
    }
}