<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Log;
>>>>>>> repoB/main

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
<<<<<<< HEAD
    {
        //
=======
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
>>>>>>> repoB/main
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        //
=======
        return view('Admin.pages.dashboard.guests.create');
>>>>>>> repoB/main
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request)
<<<<<<< HEAD
    {
        //
=======
    {   
        try{
            $validatedData=$request->validated();
            $guest=Guest::create([
                'name'=>$validatedData['name'],
                'birthDate'=>$validatedData['birthDate'],
                'phone_number'=>$validatedData['phone_number'],
                'identificationNumber'=> $validatedData['identificationNumber'],
            ]);
            return redirect()->route('guests.index')->with('status','Guest Created Successfully');
        }catch (\Exception $e) {
            Log::error('Error in GuestsController@store: ' . $e->getMessage());
            return redirect()->route('guests.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
>>>>>>> repoB/main
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
<<<<<<< HEAD
        //
=======
        return view('Admin.pages.dashboard.guests.show', compact('guest'));
>>>>>>> repoB/main
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
<<<<<<< HEAD
        //
=======
        return view('Admin.pages.dashboard.guests.edit', compact('guest'));
>>>>>>> repoB/main
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
<<<<<<< HEAD
    {
        //
=======
    {   
        try{
            $validated=$request->safe();
            $guest->update([
                "name"=>$validated->name ?? $guest->name,
                "birthDate"=>$validated->birthDate ?? $guest->birthDate,
                "phone_number"=>$validated->phone_number ?? $guest->phone_number,
                "identificationNumber"=> $validated->identificationNumber ?? $guest->identificationNumber,
            ]);
            return redirect()->route('guests.index')->with('status','Guest Updateded Successfully');
        }catch (\Exception $e) {
            Log::error('Error in GuestsController@update: ' . $e->getMessage());
            return redirect()->route('guests.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
>>>>>>> repoB/main
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
<<<<<<< HEAD
        //
=======
        try {
            $guest->delete();
            return redirect()->route('rooms.index')->with('success', 'Guest deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error in RoomController@destroy: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.guests.index')->with('error', $e->getMessage());
        }
>>>>>>> repoB/main
    }
}
