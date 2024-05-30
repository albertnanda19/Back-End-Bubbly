<?php

if (!function_exists('createResponse')) {
    function createResponse(int $status, string $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return \Config\Services::response()
            ->setStatusCode($status)
            ->setJSON($response);
    }
}
