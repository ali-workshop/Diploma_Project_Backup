<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        // room_type_id,code,,floorNumber,,description,img,status,price
        $room_type_id=RoomType::factory();
        // $description=make the sdescription related to the name of the room type using some code 
        return [
            'room_type_id'=>RoomType::factory(),
                
        ];
    }
}
