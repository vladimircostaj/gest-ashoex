<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    //
    /**
     * Function to retrieve a single formatted response for all requests
     * @param bool $success - success flag
     * @param array $data - body content 
     * @param string $message - query description message 
     * @param array $errors - single errors with code and message ex. ['code' => value, 'message' => value]
     * @return JsonResponse
     */
    public function response(bool $success, array $data, string $msg, array $error): JsonResponse
    {
        return response()->json(
            [
                'success' => $success, 
                'data' => $data, 
                'message' => $msg, 
                'error' => $error
            ], 
            (empty($error)? 200: $error['code'])
        );
    }
}
