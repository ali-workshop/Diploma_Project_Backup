<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Traits\UploadImageTrait;
use App\Http\Requests\DateRangeRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Database\Eloquent\Collection;

class RoomController extends Controller
{   
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $rooms = Room::with('roomType')
                ->whereHas('roomType', function ($query) use ($request) {
                    if ($request->has('name')) {
                        $query->where('name', 'like', '%' . $request->name . '%');
                    }
                })
                ->orderBy('floorNumber', 'asc')
                ->paginate(10);
                
            return view('Admin.pages.dashboard.rooms.index', compact('rooms'));
        } catch (\Exception $e) {
            Log::error('Error in RoomController@index: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
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
        $validatedData=$request->validated();
        $typeOThisRoom=RoomType::find($request->room_type);
        $sumOfAllAvailableServices=$typeOThisRoom->services->sum('price');
        $room=Room::create([
            "room_type_id" => $request->room_type,
            "code" => $validatedData['code'],
            "floorNumber" => $validatedData['floorNumber'],
            "description" => $validatedData['description'],
            "img" => $this->verifyAndUpload($validatedData['img'],'rooms'),
            "status" => $validatedData['status'],
            "price" => $typeOThisRoom->price +$sumOfAllAvailableServices,
        ]);

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
        $roomTypes = RoomType::all();
        return view('Admin.pages.dashboard.rooms.edit', compact('room','roomTypes'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {   
        try {
            $request->validated();
            $room->code =$request->code ?? $room->code;
            $room->room_type_id =$request->room_type_id ?? $room->room_type_id;
            $room->floorNumber = $request->floorNumber ?? $room->floorNumber;
            $room->price = $request->price ?? $room->price;
            $room->status = $request->status ?? $room->status;
            $room->description = $request->description ?? $room->description;

            if ($request->hasFile('img')) {
                $path =$this->verifyAndUpload($request->file('img'),'rooms');
                if ($path) {
                    $this->deleteImage($room->img);
                    $room->img = $path;
                } else {
                    return redirect()->back()->with('error', 'Failed to upload image.');
                }
            }
            $room->save();
            return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');

        } catch (\Exception $e) {
            Log::error('Error in RoomController@update: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $this->deleteImage($room->img);
            $room->delete();
            return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error in RoomController@destroy: ' . $e->getMessage());
            return redirect()->route('Admin.pages.dashboard.rooms.index')->with('error',$e->getMessage());
        }
    }
    public function showCurrnetAvailableRooms()
        {
            try{
            $rooms=Room::where('status','available')->get();
            // dd($rooms);
            return view('Admin.pages.dashboard.rooms.index', ['rooms'=>$rooms]);
            }catch(\Exception $e){
                Log::error('Error in RoomController@showCurrnetAvailableRooms: ' . $e->getMessage());
                return redirect()->route('rooms.index')->with('error', $e->getMessage());
            }

        }

        public function showAvailableRoomsInSpecificTime(Request $request)
        {
           try{
            $availableRooms=[];
            $rooms=Room::all();
            $specificDate = Carbon::parse($request->input('specificDate'));
            foreach($rooms as $room)
            {
                $reservations=Reservation::where('room_id',$room->id)->get();
                $available=True;
                foreach($reservations as $reservation)
                {   
                    if($specificDate->between($reservation->start_date,$reservation->end_date))
                    {
                        $available=False;
                        break;
                    }    
                }
                if($available)
                {
                    $avaliableRooms[]=$room;
                }
            }
            $rooms=collect($avaliableRooms); # ali comment : i am just ensure convert it to collection before send it to view
            return view('Admin.pages.dashboard.rooms.index',['rooms'=>$rooms]);
        }catch(\Exception $e){
            Log::error('Error in RoomController@showAvailableRoomsInSpecificTime: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }

        }
        public function showAvailableRoomsInPeriod(DateRangeRequest $request)
        {  
           #Noura could use this time zone ( Asia/Dubai )
           # other members 'Asia/Damascus'
           # Mr.Hashim Europe/Berlin
           try{
           $reservations_endDates = Reservation::pluck('end_date')->toArray();
            $latestEndDate = max($reservations_endDates);
            $latestEndDate =Carbon::parse($latestEndDate);
            $startRange = Carbon::parse($request->input('start_range'), 'UTC')
                                                ->setTimezone('Asia/Baghdad');
            $endRange=$request->has('end_range') ? 
            Carbon::parse($request->input('end_range'), 'UTC')
                                    ->setTimezone('Asia/Baghdad') : null;
            if(!$endRange)
            {
               $endRange= $latestEndDate;
            }
            
            $availableRooms=[];
            $rooms=Room::all();
    
            foreach($rooms as $room)
            {
                $reservations=Reservation::where('room_id',$room->id)->get();
                $available=True;
                foreach($reservations as $reservation)
                {   
                    if
                    (
                    $reservation->start_date <= $endRange &&
                    $reservation->end_date   >= $startRange
                    ) 
                    {
                        $available=False;
                        break;
                    }
                    
                }
                if($available)
                {
                    $avaliableRooms[]=$room;
                }
  
            }
            $rooms=collect($avaliableRooms);
            return view('Admin.pages.dashboard.rooms.index',['rooms'=>$rooms]);
        }catch(\Exception $e){
            Log::error('Error in RoomController@showAvailableRoomsInPeriod: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }


        }
        
        public function showCurrnetReservedRooms()
        { 
         try{
            $rooms=Room::where('status','booked')->get();
            return view('Admin.pages.dashboard.rooms.index',['rooms'=>$rooms]);
            }catch(\Exception $e){
                Log::error('Error in RoomController@showCurrnetReservedRooms: ' . $e->getMessage());
                return redirect()->route('rooms.index')->with('error', $e->getMessage());
            } 
        }
        
        public function showReservedRoomsInSpecificTime(Request $request)
        {  
         try{    
            $reservedRooms=[];
            $rooms=Room::all();
            $specificDate = Carbon::parse($request->input('specificDate'));
            foreach($rooms as $room)
            {
                $reservations=Reservation::where('room_id',$room->id)->get();
                $available=False;
                foreach($reservations as $reservation)
                {   
                    if($specificDate->between($reservation->start_date,$reservation->end_date))
                    {
                        $available=True;
                        break;
                    }      
                }
                if($available)
                {
                    $reservedRooms[]=$room;
                }
            }
            $rooms=collect($reservedRooms);
            return view('Admin.pages.dashboard.rooms.index',['rooms'=>$rooms]);
        }catch(\Exception $e){
            Log::error('Error in RoomController@showReservedRoomsInSpecificTime: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }
        }
        
        public function showReservedRoomsInPeriod(DateRangeRequest $request)
        {   
         try{
            $reservations_endDates = Reservation::pluck('end_date')->toArray();
            $latestEndDate = max($reservations_endDates);
            $latestEndDate =Carbon::parse($latestEndDate);
            $startRange = Carbon::parse($request->input('start_range'), 'UTC')
                                                ->setTimezone('Asia/Baghdad');
            $endRange=$request->has('end_range') ? 
            Carbon::parse($request->input('end_range'), 'UTC')
                                    ->setTimezone('Asia/Baghdad') : null;
            if(!$endRange)
            {
               $endRange= $latestEndDate;
            }
            $reservedRooms=[];
            $rooms=Room::all();
             foreach($rooms as $room)
                 {
                $reservations=Reservation::where('room_id',$room->id)->get();
                $available=False;
                foreach($reservations as $reservation)
                {   
                    if
                    (
                    $reservation->start_date <= $endRange &&
                    $reservation->end_date   >= $startRange
                    ) 
                    {
                        $available=True;
                        break;
                    }
                    
                }
                if($available)
                {
                    $reservedRooms[]=$room;
                }
            }
            $rooms=collect($reservedRooms);
            return view('Admin.pages.dashboard.rooms.index',['rooms'=>$rooms]);
        }catch(\Exception $e){
            Log::error('Error in RoomController@showReservedRoomsInPeriod: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }
        }       
}


       
