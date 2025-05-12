<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
     /**
      * get success json response
      */
    public function successResponse($data = null, string $message = 'Success!', int $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * get failed json response
     */
    public function errorResponse(string $message = 'oops!Something went wrong', int $code = 400, $errors = []): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], $code);
    }
}
