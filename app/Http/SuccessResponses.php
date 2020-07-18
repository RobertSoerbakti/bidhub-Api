<?php

namespace App\Http;

trait SuccessResponses
{
    /**
     * @param $message
     * @param null $data
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     *
     * Success Response function
     */
    public function successResponse($message, $data = null, $statusCode = StatusCode::OK)
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
