<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     function generateRoomDescription(string $roomTypeName): string {
        $roomTypeInstanses=RoomType::all();
        $roomType = $roomTypeInstanses->firstWhere('name', $roomTypeName);
        //$roomType=roomType::where('name',"LIKE",$roomTypeName)->first();
        $descriptions = [
            'Standard Single Room' => [
                'This room is a standard single room, perfect for solo travelers.',
                'The room area is two square meters and contains a small bed.',
                'It offers a comfortable stay with all basic amenities.'
            ],
            'Standard Suite' => [
                'This room is a standard suite, ideal for couples or small families.',
                'The room area is two square meters and has a large bed.',
                'Enjoy a spacious area with extra comforts.'
            ],
            'VIP Single Room' => [
                'This room is a VIP single room, providing luxurious amenities for solo travelers.',
                'The room area is two square meters and contains two beds.',
                'Experience the best in comfort and service.'
            ],
            'VIP Suite' => [
                'This room is a VIP suite, perfect for those seeking luxury and space.',
                'The room area is three square meters and contains two large beds.',
                'Relax and unwind in the most luxurious setting.',
            ],
        ];

        return isset($descriptions[$roomTypeName])
            ? implode(' ', $descriptions[$roomTypeName])
            : $roomType->description;
    }

    public function definition(): array
    {   
        // select type of room     
        $roomTypeId=RoomType::get('id')->random();
        $roomType=RoomType::find($roomTypeId)->first();
        $sumPricesOfAllAvailableServices=$roomType->services->sum('price');

        // Define the ratio
        $availableRatio = 0.85;
        // Generate a random float between 0 and 1
        $randomFloat = $this->faker->randomFloat(2,0,1);

        // Select the element based on the ratio
        $selectedStatus = $randomFloat < $availableRatio ? 'available' : 'unavailable';

        $floor=$this->faker->numberBetween(0,15);
        // Regular expression for a room code format
        $roomCodePattern = '/([0-9]|[1-9][0-9])[A-D]?$/';
        $floor=$this->faker->numberBetween(1,15);

        return [
            'room_type_id' => $roomTypeId,
            'code'=>$this->faker->regexify($roomCodePattern).$floor,
            'floorNumber'=> $floor, 
            'description'=> $this->generateRoomDescription($roomType->name),
            //'images'=> $this->faker->imageUrl(),
            'status'=>$selectedStatus, 
            'price'=> $roomType->price + $sumPricesOfAllAvailableServices, 
        ];
    }
}
