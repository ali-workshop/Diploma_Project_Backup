<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponserTrait;
use App\Http\Requests\DateRangeRequest;

class RoomController extends Controller
{
    use ApiResponserTrait;
    public function showCurrnetAvailableRooms()
    {
        try {
            $rooms = Room::where('status', 'available')->get();
            return $this->successResponse([$rooms], 'Availabe Rooms Returned Successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
        }

    }

    public function showAvailableRoomsInSpecificTime(Request $request)
    {
        try {
            $availableRooms = [];
            $rooms = Room::all();
    
            $specificDate = Carbon::parse($request->input('specificDate'));
            foreach ($rooms as $room) {
                $reservations = Reservation::where('room_id', $room->id)->get();
                $available = true;
                foreach ($reservations as $reservation) {
                    if ($specificDate->between($reservation->start_date, $reservation->end_date))
                    {
                     $available = false;
                     break;
                    }
                }
                if ($available) {
                    $availableRooms[] = $room;
                }
            }
            return $this->successResponse($availableRooms, 'Available Rooms Returned Successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
        }

    }

    public function showAvailableRoomsInPeriod(DateRangeRequest $request)
    {
        #Noura could use this time zone ( Asia/Dubai )
        # other members 'Asia/Damascus'
        # Mr.Hashim Europe/Berlin
        try {
            $reservations_endDates = Reservation::pluck('end_date')->toArray();
            $latestEndDate = max($reservations_endDates);
            $latestEndDate = Carbon::parse($latestEndDate);
            $startRange = Carbon::parse($request->input('start_range'), 'UTC')
                                                ->setTimezone('Asia/Baghdad');
            $endRange = $request->has('end_range') ?
                Carbon::parse($request->input('end_range'), 'UTC')
                ->setTimezone('Asia/Baghdad') : null;
            if (!$endRange) {
                $endRange = $latestEndDate;
            }
            $availableRooms = [];
            $rooms = Room::all();

            foreach ($rooms as $room) {
                $reservations = Reservation::where('room_id', $room->id)->get();
                $available = True;
                foreach ($reservations as $reservation) {

                    if
                    (
                        $reservation->start_date <= $endRange &&
                        $reservation->end_date >= $startRange
                    ) {

                        $available = False;
                        break;
                    }

                }
                if ($available) {
                    $avaliableRooms[] = $room;
                }

            }
            return $this->successResponse($avaliableRooms, 'Availabe Rooms Returned Successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
        }


    }

    public function showCurrnetReservedRooms()
    {
        try {
            $rooms = Room::where('status', 'booked')->get();
            return $this->successResponse([$rooms], 'Booked Rooms Returned Successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
        }
    }

    public function showReservedRoomsInSpecificTime(Request $request)
    {
        try {

            $reservedRooms = [];
            $rooms = Room::all();
            $specificDate = Carbon::parse( $request->input('specificDate'));
            foreach ($rooms as $room) {
                $reservations = Reservation::where('room_id', $room->id)->get();
                $available = False;
                foreach ($reservations as $reservation) {
                    if ($specificDate->between($reservation->start_date, $reservation->end_date))
                     {
                        $available = True;
                        break;
                    }
                }
                if ($available) {
                    $reservedRooms[] = $room;
                }
            }
            return $this->successResponse($reservedRooms, 'Booked Rooms Returned Successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
        }
    }

    public function showReservedRoomsInPeriod(DateRangeRequest $request)
    {
        try {
            $reservations_endDates = Reservation::pluck('end_date')
                                                ->toArray();
            $latestEndDate = max($reservations_endDates);
            $latestEndDate = Carbon::parse($latestEndDate);
            $startRange = Carbon::parse($request->input('start_range'), 'UTC')
                                                ->setTimezone('Asia/Baghdad');
            $endRange = $request->has('end_range') ?
                Carbon::parse($request->input('end_range'), 'UTC')
                                    ->setTimezone('Asia/Baghdad') : null;
            if (!$endRange) {
                $endRange = $latestEndDate;
            }
            $reservedRooms = [];
            $rooms = Room::all();
            foreach ($rooms as $room) {
                $reservations = Reservation::where('room_id', $room->id)->get();
                $available = False;
                foreach ($reservations as $reservation) {
                    if
                    (
                        $reservation->start_date <= $endRange &&
                        $reservation->end_date >= $startRange
                    ) {
                        $available = True;
                        break;
                    }

                }
                if ($available) {
                    $reservedRooms[] = $room;
                }

            }
            return $this->successResponse($reservedRooms, 'Booked Rooms Returned Successfully');
        } catch (\Throwable $th) {
            return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
        }
    }

}
