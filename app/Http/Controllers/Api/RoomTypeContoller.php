<?php

namespace App\Http\Controllers\Api;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\RoomTypeResource;

class RoomTypeContoller extends Controller
{
    use ApiResponseTrait;  
  public function index(){
    try{
        $roomsType = RoomType::all();
        $roomsType=RoomTypeResource::collection($roomsType);
        if ($roomsType->isNotEmpty()) {
          return $this->successResponse('this is all room types', $roomsType, 200);
        }else
          return $this->notFound('there are not any rooms type!',404);
      }catch(\Exception $e){
          return $this->errorResponse( $e->getMessage(),500); 
      }
  
   }

}