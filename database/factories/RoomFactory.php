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
        // $roomType=roomType::where('name',"LIKE",$roomTypeName)->first();
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
        
        $roomType_ids=RoomType::pluck('id')->toArray();
        $roomType_id=$this->faker->randomElement($roomType_ids);
        $roomTypePrice=RoomType::firstWhere('id',$roomType_id)->price;

        $service_ids=Service::pluck('id')->toArray();
        $service_id=$this->faker->randomElement($service_ids);
        $servicePrice=Service::firstWhere('id',$service_id)->price;

        $roomPrice= $roomTypePrice+$servicePrice;
        $randomRoomTypeId = $this->faker->randomElement($roomType_ids);
        $roomTypeName=RoomType::firstWhere('id',$randomRoomTypeId)->name;
        return [
            
            'room_type_id' => $randomRoomTypeId,
            'code'=>$this->faker->numberBetween(1,10), 
            'floorNumber'=>$this->faker->numberBetween(1,10), 
            'description'=>$this->generateRoomDescription($roomTypeName),
            'img'=> $this->faker->imageUrl(),
            'status'=>$this->faker->randomElement(['booked','available']), 
            'price'=>$roomPrice, 
        ];
    }
}
