<?php

namespace App\Services;

class JsonResponseService
{
    public static function getJsonException($exception)
    {
        return response()->json([
            'message' => 'exception',
            'status' => 409,
            'response' => isset($exception->errorInfo[2]) ? $exception->errorInfo[2] : $exception->getMessage(),
        ], 409);
    }

    public static function getJsonSuccess($data)
    {
        return response()->json([
            'message' => 'success',
            'status' => 200,
            'response' => $data,
        ], 200);
    }

    public static function getJsonFailed($data)
    {
        return response()->json([
            'message' => 'Failed',
            'status' => 400,
            'response' => $data,
        ], 400);
    }
}
