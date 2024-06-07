<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RoomType>
 */
class RoomTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Standard Single Room,Standard Suite,VIP Single Room,VIP Suite
        $RoomData=[
            'name'=>['$'],
             'price'=>[''],
             'capacity'=>[''],
             'description'=>[''],

        ];
        $roomType=$this->faker->randomElement(array_keys($RoomData));
        $roomOtherInfo=$RoomData[$roomType];

        return [
            
            'name'=>$roomType,
            'price'=>$roomOtherInfo['price'],
            'capacity'=>$roomOtherInfo['capacity'],
            'description'=>$roomOtherInfo['description'],

        ];
    }
}
