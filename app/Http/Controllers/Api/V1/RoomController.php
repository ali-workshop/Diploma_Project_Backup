<?php

namespace App\Http\Controllers\Api\V1;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{

     
//     return $this->successResponse($reservationStatusOverTime, 'Reservation Events Returned Successfully');
// } catch (Throwable $th) {
//     return $this->errorResponse('Server error probably.', [$th->getMessage()], 500);
// }
   
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
    

            $specificDate = Carbon::createFromFormat('Y-m-d', $request->input('specificDate'));
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
            $rooms=collect($avaliableRooms);
            return view('Admin.pages.dashboard.rooms.index',['rooms'=>$rooms]);
        }catch(\Exception $e){
            Log::error('Error in RoomController@showAvailableRoomsInSpecificTime: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', $e->getMessage());
        }

        }

        public function showAvailableRoomsInPeriod(Request $request)
        {  
           #noura could use this time zone ( Asia/Dubai )
           # other members 'Asia/Damascus'
           # Mr.Hashim Europe/Berlin
           try{
           $reservations_endDates = Reservation::pluck('end_date')->toArray();
            $latestEndDate = max($reservations_endDates);
            $latestEndDate =Carbon::parse($latestEndDate);
            $startRange = Carbon::parse($request->input('start_range'), 'UTC')->setTimezone('Asia/Baghdad');
            $endRange=$request->has('end_range') ? 
            Carbon::parse($request->input('end_range'), 'UTC')->setTimezone('Asia/Baghdad') : null;
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
            $specificDate = Carbon::createFromFormat('Y-m-d', $request->input('specificDate'));
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
        
        public function showReservedRoomsInPeriod(Request $request)
        {  
        
         try{
            $reservations_endDates = Reservation::pluck('end_date')->toArray();
            $latestEndDate = max($reservations_endDates);
            $latestEndDate =Carbon::parse($latestEndDate);
            $startRange = Carbon::parse($request->input('start_range'), 'UTC')->setTimezone('Asia/Baghdad');
            $endRange=$request->has('end_range') ? 
            Carbon::parse($request->input('end_range'), 'UTC')->setTimezone('Asia/Baghdad') : null;
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
