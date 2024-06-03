<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreContactRequest;
use App\Http\Traits\ApiResponserTrait;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller
{
    use ApiResponserTrait;
    public function store(StoreContactRequest $request)
    {
        // $request->validated();
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $contact = new Contact();
                $contact->user_id = $user->id; 
                $contact->name = $user->name; 
                $contact->email = $user->email; 
                $contact->phone = $request->phone;
            } else {
                $user = User::where('name', $request->name)
                            ->where('email', $request->email)
                            ->first();
                $contact = new Contact();
                if ($user) {
                    $contact->user_id = $user->id;
                } else {
                    $contact->user_id = null;
                }
                $contact->name = $request->name;
                $contact->email = $request->email; 
                $contact->phone = $request->phone;
            }
            $contact->save();
            return $this->successResponse($contact->toArray(), 'Contact created successfully.', 201);
        } catch (\Exception $e) {
            Log::error('Error in ContactController@store: ' . $e->getMessage());
            return $this->errorResponse('An error occurred: ' . $e->getMessage(), [], 500);
        }
    }  
}



