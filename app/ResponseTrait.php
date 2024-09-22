<?php

namespace App;

trait ResponseTrait
{
    public function successResponse($message, $code, $data = null)
    {
        return $this->response([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function failResponse($message, $code)
    {
        return $this->response([
            'status' => false,
            'message' => $message,
        ], $code);
    }

    private function response($data, $code)
    {
        return response()->json($data, $code);
    }
}
