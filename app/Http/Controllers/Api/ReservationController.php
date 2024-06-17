<?php

namespace App\Http\Controllers\Api;

use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponserTrait;
use App\Http\Traits\ApiReservationTrait;
use App\Http\Resources\ReservationResource;
use App\Http\Requests\StoreReservationRequest;



class ReservationController extends Controller
{
    use ApiResponserTrait, ApiReservationTrait;

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try {
            $userId = auth('sanctum')->user()->id;
            $reservations = Reservation::where('user_id', $userId)->get();
            $reservationData = ReservationResource::collection($reservations)->toArray(request());
            return $this->successResponse($reservationData, 'All Your reservations', 200);
        } catch (\Exception $e) {
            $errorMessage = "Error in ReservationController@index: " . $e->getMessage();
            Log::error($errorMessage);
            $errorData = [
                'exception_class' => get_class($e),
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ];
            return $this->errorResponse('An error occurred while bringing user reservations.', $errorData, 500);
        }
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
        
    }
    
    public function MyLatestReservation()
    {
        try {
            $userId = auth('sanctum')->user()->id;
            $latestReservation = Reservation::where('user_id', $userId)->orderByDesc('created_at')->first();
            if ($latestReservation) {
                $reservationData = new ReservationResource($latestReservation);
                return $this->successResponse($reservationData->toArray(request()), 'Latest Reservation', 200);
            } else {
                return $this->errorResponse('No reservation found for the user.', [], 404);
            }
        } catch (\Exception $e) {
            $errorMessage = "Error in ReservationController@showMyLatestReservation: " . $e->getMessage();
            Log::error($errorMessage);
            $errorData = [
                'exception_class' => get_class($e),
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ];
            return $this->errorResponse('An error occurred while fetching the latest reservation.', $errorData, 500);
        }
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
