<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Http\Requests\StoreRoomTypeRequest;
use App\Http\Requests\UpdateRoomTypeRequest;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomsType = RoomType::all();
        return view('Admin.pages.dashboard.room_types.index', compact('roomsType'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.pages.dashboard.room_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomTypeRequest $request)
    {
        try {
            $request->validated();
            $new_room_type = new RoomType();
            $new_room_type->name = $request->name;
            $new_room_type->price = $request->price;
            $new_room_type->capacity = $request->capacity;
            $new_room_type->description = $request->description;
            $new_room_type->save();
            return redirect()->route('roomType.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomType $roomType)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomType $roomType)
    {
        return view('Admin.pages.dashboard.room_types.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        try {
            $request->validated();
            $roomType->name = $request->name;
            $roomType->price = $request->price;
            $roomType->capacity = $request->capacity;
            $roomType->description = $request->description;
            $roomType->save();
            return redirect()->route('roomType.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->route('roomType.index');
    }
}
