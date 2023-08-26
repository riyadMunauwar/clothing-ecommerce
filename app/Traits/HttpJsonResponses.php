<?php 


namespace App\Traits;



trait HttpJsonResponses {

    protected function jsonSuccessResponseMetaData($message = null)
    {
        return [
            'success' => true,
            'message' => $message
        ];
    }

    protected function jsonSuccessResponse($data = [], $message = '', $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'code' => $code,
            'data' => $data,
        ], $code);
    }

    protected function jsonErrorResponse($message = '', $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'code' => $code,
        ], $code);
    }
}