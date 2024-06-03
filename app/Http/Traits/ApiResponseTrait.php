<?php
namespace App\Http\Traits;

Trait ApiResponseTrait{

    public function apiResponse($success,$message,$data=null,$statusCode=200){
        return response()->json([

            'success'  =>$success,
            'message'  =>$message,
            'data'     =>$data,
        ],$statusCode);
    }
 
    public function successResponse($message,$data=null,$statusCode=200){
        return $this->apiResponse(true,$message,$data,$statusCode);
    }

    public function errorResponse($message,$statusCode=500){
        return $this->apiResponse(false,$message,null,$statusCode);
    }

    public function notFound($message){

        return response()->json([
            'success'  =>false,
            'message'  =>$message,
            'code'     =>404
        ]);
    }

   

}
