<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\ResponseHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    use ResponseHandlerTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|numeric|exists:users,id',
            'title' => 'required|min:10|string',
            'content' => 'required|min:10|string'
        ];
    }
}