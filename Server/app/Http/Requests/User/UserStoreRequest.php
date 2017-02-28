<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
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

    public function response(array $errors)
    {
        if(count($errors) > 0) {
            return response()->json(['success' => false, 'message' => 'Failed pass validation', 'errors' => $errors], 400);
        }

        return true;
    }
}