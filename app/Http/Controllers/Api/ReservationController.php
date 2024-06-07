<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Message;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponserTrait;
use App\Http\Requests\StoreReservationRequest;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        try {
            $user = auth('sanctum')->user()->id;
            $room = Room::findOrFail($request->input('room_id'));
    
            $reservation = Reservation::create([
                'user_id' => $user,
                'room_id' => $room->id,
                'code' => $request->input('code'),
                'guestNumber' => $request->input('guestNumber'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'totalPrice' => $request->input('totalPrice'),
            ]);
    
            return $this->successResponse($reservation->toArray(), 'Reservation created successfully.', 201);
        } catch (\Exception $e) {
            Log::error('Error in ReservationController@store: ' . $e->getMessage());
            return $this->errorResponse('An error occurred while creating the reservation.', [], 500);}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
