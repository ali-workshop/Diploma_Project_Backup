<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponserTrait;
use App\Models\ReservationStatusEvent;
use App\Models\ReservationStatusCatlog;

class ReservationEventController extends Controller
{
    use ApiResponserTrait;

    public function reservationEvents(Reservation $reservation)
    {   
        # ALI and TUKA achieve this logic within best practice ways (Relation Eager + map functionality)

        try {
            
            $reservationEvents = ReservationStatusEvent::with('reservationStatusCatalogs')
                                ->where('reservation_id', $reservation->id)
                                ->get();
            $reservationStatusOverTime = [];

            $reservationStatusOverTime = $reservationEvents->map(function ($reservationEvent) {
                    return [
                        'currentStatus' => $reservationEvent->reservationStatusCatalogs->name,
                        'currentEventDate' => $reservationEvent->created_at->format('d-m-Y H:i:s'),
                    ];
                })->toArray(); 
                return $this->successResponse($reservationStatusOverTime, 'Reservation Events Returned Successfully');
              } catch (Throwable $th) {
                return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
                                    }
    }

}