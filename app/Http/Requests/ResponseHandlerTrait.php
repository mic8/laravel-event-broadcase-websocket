<?php

namespace App\Http\Requests;

trait ResponseHandlerTrait
{
    /**
     * @param array $errors
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        if(count($errors) > 0) {
            return response()->json(['success' => false, 'message' => 'Failed pass validation', 'errors' => $errors], 400);
        }

        return true;
    }
}