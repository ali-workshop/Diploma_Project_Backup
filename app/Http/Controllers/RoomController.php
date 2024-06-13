<?php

namespace App\Http\Controllers;


use App\Models\Room;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Traits\UploadImageTrait;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        //compute room cost per night
        $typeOThisRoom=RoomType::find($request->room_type);
        $sumPricesOfAllAvailableServices=$typeOThisRoom->services->sum('price');
        //
        if($request->has('images')){
            $roomImages=array();
            foreach($request->file('images') as $key=>$img){
                $path=$this->UploadMultipleImages($img,'rooms',$validatedData['code'].$key);
                if($path){
                    array_push($roomImages,$path);
                }
            }
        }
        $room=Room::create([
            "room_type_id" => $request->room_type,
            "code" => $validatedData['code'],
            "floorNumber" => $validatedData['floorNumber'],
            "description" => $validatedData['description'],
            "images" =>  json_encode($roomImages),
            "status" => $validatedData['status'],
            "price" => $typeOThisRoom->price +$sumPricesOfAllAvailableServices,
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
//     public function update(Request $request, $id)
// {
//     $room = Room::findOrFail($id);

//     // Decode the existing images JSON column
//     $existingImages = json_decode($room->images, true) ?? [];

//     // Handle deletion of selected images
//     if ($request->filled('delete_images')) {
//         $deleteImages = json_decode($request->delete_images, true);
//         foreach ($deleteImages as $image) {
//             // Remove the image file from the server
//             $filePath = public_path('images/'.$image);
//             if (file_exists($filePath)) {
//                 unlink($filePath);
//             }
//             // Remove the image from the existing images array
//             $existingImages = array_filter($existingImages, function ($img) use ($image) {
//                 return $img !== $image;
//             });
//         }
//     }

//     // Handle addition of new images
//     if ($request->hasfile('new_images')) {
//         foreach ($request->file('new_images') as $image) {
//             $name = time() . '-' . $image->getClientOriginalName();
//             $image->move(public_path('images'), $name);
//             $existingImages[] = $name;
//         }
//     }

//     // Encode the updated images array to JSON and save to the database
//     $room->images = json_encode(array_values($existingImages));
//     $room->save();

//     return back()->with('success', 'Images updated successfully');
// }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {   
        try {
            $existingImages =json_decode($room->images,true);
            $validatedData=$request->validated();
            if ($request->filled('delete_images')) {
                $deleteImages = json_decode($request->delete_images, true);
                foreach ($deleteImages as $image) {
                    // Remove the image file from the server
                    $filePath = public_path('images/'.$image);
                    if (file_exists($filePath)) {
                        $this->deleteImage($image);
                    }
                    // Remove the image from the existing images array
                    $existingImages = array_filter($existingImages, function ($img) use ($image) {
                        return $img !== $image;
                    });
                }
            }
            // Handle addition of new images
            if ($request->hasfile('new_images')) {
                foreach ($request->file('new_images') as $key=>$image) {
                    $path=$this->UploadMultipleImages($image,'rooms',$validatedData['code'].$key);
                    $existingImages[] = $path;
                }
            }
            $room->code =$request->code ?? $room->code;
            $room->room_type_id =$request->room_type_id ?? $room->room_type_id;
            $room->floorNumber = $request->floorNumber ?? $room->floorNumber;
            $room->price = $request->price ?? $room->price;
            $room->status = $request->status ?? $room->status;
            $room->description = $request->description ?? $room->description;
            $room->images = json_encode($existingImages);// Encode the updated images array to JSON and save to the database
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
}
