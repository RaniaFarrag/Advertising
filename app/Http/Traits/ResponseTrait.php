<?php


namespace App\Http\Traits;


trait ResponseTrait
{
    public function success($data = [], $status = 200){
        return response([
            'success' => 'true',
            'data'    => $data,
            'status'  => $status
        ]);
    }

    public function failure($message, $status = 422){
        return response([
            'success' => 'false',
            'message' => $message,
            'status'  => $status
        ]);
    }

    public function deleteSuccessfully($message, $status = 200){
        return response([
            'success' => 'true',
            'message' => $message,
            'status'  => $status
        ]);
    }

}
