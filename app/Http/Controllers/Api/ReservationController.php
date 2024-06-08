<?php

namespace App\Http\Controllers\Api;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponserTrait;
use App\Http\Traits\ApiReservationTrait;
use App\Http\Requests\StoreReservationRequest;




class ReservationController extends Controller
{
    use ApiResponserTrait, ApiReservationTrait;

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
            $request->validated();
            $user = auth('sanctum')->user();
            $room = Room::find($request->room_id);
            return $this->ReservationHandle($user, $room,  $request);
        } catch (\Exception $e) {
            Log::error('Error in ReservationController@store: ' . $e->getMessage());
            return $this->errorResponse('An error occurred while creating the reservation.', [], 500);
        }
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
