<?php

namespace App\Http\Controllers;


use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\RoomType;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return view('Admin.pages.dashboard.rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomTypes = RoomType::all();
        return view('Admin.pages.dashboard.rooms.create' , compact('roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $request->validated();

        $Room = new Room();
        $Room->room_type_id =RoomType::find($request->room_type)->id;
        $Room->code = $request->code;
        $Room->floorNumber = $request->floorNumber;
        $Room->description = $request->description;
        $Room->img = $request->img;
        $Room->status = $request->status;
        $Room->price = $request->price;
        $Room->save();

        return redirect()->route('rooms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return view('Admin.pages.dashboard.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        return view('Admin.pages.dashboard.rooms.edit', compact('room'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $request->validated();

        $room->room_type_id = $request->room_type_id;
        $room->code = $request->code;
        $room->floorNumber = $request->floorNumber;
        $room->description = $request->description;
        $room->img = $request->img;
        $room->status = $request->status;
        $room->price = $request->price;
        $room->save();
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
