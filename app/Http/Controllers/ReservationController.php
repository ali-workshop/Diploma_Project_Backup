<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Support\Facades\Log;
use App\Models\ReservationStatusEvent;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Http\Traits\ApiReservationTrait;

class ReservationController extends Controller
{
    use ApiReservationTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $reservations = Reservation::all();
            return view('Admin.pages.dashboard.reservation.index', compact('reservations'));
        } catch (\Exception $e) {

            Log::error('Error in RoomsController@index: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.reservation.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        try
        {
            $stayingNights = $this->CalculateDateTime($reservation->start_date, $reservation->end_date);
            $services = $reservation->room->roomType->services->map(function($service) {
                return [
                    'name' => $service->name,
                    'price' => $service->price,
                ];
            });
            return view('Admin.pages.dashboard.reservation.show', compact('reservation' ,'stayingNights','services'));
        }catch (\Exception $e) {

            Log::error('Error in RoomsController@index: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.reservation.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    
}
