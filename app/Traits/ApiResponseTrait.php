<?php

namespace App\Traits;

trait ApiResponseTrait
{
    /**
     * رد ناجح
     */
    public function successResponse($data = [], $message = 'Success', $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * رد خطأ
     */
    public function errorResponse($message = 'Error', $status = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => null,
        ], $status);
    }
}
