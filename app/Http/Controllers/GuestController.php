<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use Illuminate\Support\Facades\Log;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        try{
        $guests = Guest::with('reservations')
            ->withCount('reservations')
            ->latest()
            ->paginate(20);
            return view('Admin.pages.dashboard.guests.index', compact('guests'));
        }catch (\Exception $e) {
            Log::error('Error in GuestsController@index: ' . $e->getMessage());
            return redirect()->route('guests.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.dashboard.guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request)
    {   
        try{
        $validatedData=$request->validated();
        $guest=Guest::create([
            'name'=>$validatedData['name'],
            'birthDate'=>$validatedData['birthDate'],
            'identificationNumber'=> $validatedData['identificationNumber'],
        ]);
        return redirect()->route('guests.index')->with('status','Book Created Successfully');
        }catch (\Exception $e) {
            Log::error('Error in GuestsController@store: ' . $e->getMessage());
            return redirect()->route('guests.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return view('Admin.pages.dashboard.guests.show', compact('guest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('Admin.pages.dashboard.guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
    {   
        try{
        $validated=$request->safe();
        $guest->update([
            "name"=>$validated->name ?? $guest->name,
            "birthDate"=>$validated->birthDate ?? $guest->birthDate,
            "identificationNumber"=> $validated->identificationNumber ?? $guest->identificationNumber,
        ]);
        }catch (\Exception $e) {
            Log::error('Error in GuestsController@update: ' . $e->getMessage());
            return redirect()->route('guests.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        try {
            $guest->delete();
            return redirect()->route('rooms.index')->with('success', 'Guest deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error in RoomController@destroy: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.guests.index')->with('error', $e->getMessage());
        }
    }
}
