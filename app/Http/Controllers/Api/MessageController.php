<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreMessageRequest;
use App\Http\Traits\ApiResponserTrait;
use App\Models\Message;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    use ApiResponserTrait;
    public function store(StoreMessageRequest $request)
    {
        try {
            $message = new Message(); 
            $message->contact_id = $request->contact_id;
            $message->title = $request->title;
            $message->body = $request->body;
            $message->save();
            return $this->successResponse($message->toArray(), 'Message created successfully.', 201);
        } catch (\Exception $e) {
            Log::error('Error in MessageController@store: ' . $e->getMessage());
            return $this->errorResponse('An error occurred: ' . $e->getMessage(), [], 500);
        }
    }
}

