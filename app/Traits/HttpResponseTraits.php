<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;

trait HttpResponseTraits
{
    protected function success(mixed $payload = null, $message = 'success' , $code = 200)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $payload
        ],200);
    }

    protected function dataNotFound($message = 'Data not found', $code = 404) {
        return response()->json([
            'code' => $code,
            'message' => $message
        ],404);
    }

    protected function idOrDataNotFound($message = 'Id or data not found', $code = 404) {
        return response()->json([
            'code' => $code,
            'message' => $message
        ],404);
    }

    protected function delete($message = 'Success delete', $code = 200) {
        return response()->json([
            'code' => $code,
            'message' => $message
        ],200);
    }

    protected function error(string $message = 'error', int $code = 400, mixed $payload = null, mixed $class = null, string $method = '')
    {
        $data = [
            'code' => $code,
            'message' => $message
        ];

        if ($payload) {
            Log::error($class, [
                'Message: ' . $payload->getMessage(),
                'Method: '  . $method,
                'On File: ' . $payload->getFile(),
                'On Line: ' . $payload->getLine()
            ]);
        }
        return response()->json($data,400);
    }
}