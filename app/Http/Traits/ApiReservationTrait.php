<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use App\Models\Reservation;
use App\Http\Traits\ApiResponserTrait;

trait ApiReservationTrait
{
    use ApiResponserTrait;

    protected function ReservationHandle($user, $room, $request)
    {
        $validationResponse = $this->validateReservationRequest($request, $room);
        if ($validationResponse !== true) {
            return $validationResponse;
        }
        
        // API Response for Unavailable Room and Showing list of Reservations for this room During the time of the request //  
        $roomAvailabilityData = $this->isRoomUnavailable($room->id, $request->start_date, $request->end_date);

        if ($roomAvailabilityData['roomUnavailable']) {
            return $this->errorResponse('Room is not available for the selected dates', [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reservations' => $roomAvailabilityData['reservations']
            ], 400);
        }
        
        /////////// information needed for making new reservation /////////////// 
        $typeOThisRoom = $room->roomType;
        $days = $this->CalculateDateTime($request->start_date , $request->end_date);
        $total_price= $room->price * $days;

        ////////// making new Reservation after the request been validated ///////////
        $reservation = new Reservation();
        $reservation->user_id = $user->id;
        $reservation->room()->associate($room);
        $reservation->code = $request->code;
        $reservation->guestNumber = $request->guestNumber;
        $reservation->start_date = $request->start_date;
        $reservation->end_date = $request->end_date;
        $reservation->totalPrice = $total_price;
        $reservation->save();

        

        //////// Prepare successful reservation response ////////////

        $successfulReservationResponse = [
            'user_name' => $user->name,
            'reservation_code' => $reservation->code,
            'guest_number' => $reservation->guestNumber,
            'start_date' => $reservation->start_date,
            'end_date' => $reservation->end_date,
            'room_type' => $typeOThisRoom->name,
            'room_services' => $typeOThisRoom->services->pluck('name'),
            'bill_details' => [
                'RoomServices'=>$typeOThisRoom->services->pluck('price') ,
                'RoomTypePrice'=>$typeOThisRoom->price, 
                'Room Price = (Room services price + Room Type price )'=> $room->price ,
                'Nights of staying'=> $days 
            ],
            'total_price = (Room services + Room Type price)*(Nights of staying)' => $reservation->totalPrice,
        ];

        return $this->successResponse($successfulReservationResponse, 'Reservation created successfully.', 201);
    }




    protected function validateReservationRequest($request, $room)
    {
        if (!$room) {
            return $this->errorResponse('Room not found', ['room_id' => null], 404);
        }

        $roomType = $room->roomType;

        if ($request->guestNumber > $roomType->capacity) {
            return $this->errorResponse('The number of guests is greater than the capacity of the room', ['guestNumber' => $request->guestNumber, 'Room_Capacity' => $roomType->capacity], 400);
        }

        if ($request->start_date > $request->end_date) {
            return $this->errorResponse('The start date is after the the end date in time !!!', ['start_date' => $request->start_date], 400);
        }

        $currentDate = date('Y-m-d');

        if ($request->start_date < $currentDate) {
            return $this->errorResponse('You have entered a start date in the past !!!!', ['start_date' => $request->start_date], 400);
        }

        if ($request->end_date < $currentDate) {
            return $this->errorResponse('The end date is the past !!!!', ['end_date' => $request->end_date], 400);
        }

        if ($request->start_date == $request->end_date) {
            return $this->errorResponse('The start date is equal to the end date, it must be at least one night', ['start_date' => $request->start_date], 400);
        }

        return true;
    }



    protected function isRoomUnavailable($room_id, $start_date, $end_date)
    {
        $reservations = Reservation::where('room_id', $room_id)
            ->where(function ($query) use ($start_date, $end_date) {
                $query->whereBetween('start_date', [$start_date, $end_date])
                    ->orWhereBetween('end_date', [$start_date, $end_date])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$start_date])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$end_date]);
            })
            ->get();

        $roomUnavailable = $reservations->isNotEmpty();

        return [
            'roomUnavailable' => $roomUnavailable,
            'reservations' => $reservations,
        ];
    }


    protected function CalculateDateTime($start_date , $end_date )
    {
        $start = Carbon::parse($start_date);
        $end = Carbon::parse($end_date);
        $daysDifference = $start->diffInDays($end);
        return $daysDifference ;
    }
}
