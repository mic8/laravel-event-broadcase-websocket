<?php

namespace App\Http\Requests\User;

use App\Http\Requests\ResponseHandlerTrait;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    use ResponseHandlerTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'unique:users|email|required',
            'password' => 'required|min:6',
            'name' => 'required|min:6'
        ];
    }
}