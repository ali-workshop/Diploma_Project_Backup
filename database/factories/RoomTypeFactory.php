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
        $RoomData=[
            'Standard Single Room' => [
                'descriptions' => [
                    'The room area is two square meters and contains a small bed',
                    
                ],
                'prices' => [50, 60, 70], 
                'capacities' => [1] 
            ],
            'Standard Suite' => [
                'descriptions' => [
                   'The room area is two square meters and has a large bed',
                ],
                'prices' => [100, 120, 140], 
                'capacities' => [2, 3] 
            ],
            'VIP Single Room' => [
                'descriptions' => [
                'The room area is two square meters and contains two beds',
                ],
                'prices' => [150, 180, 200],
                'capacities' => [1, 2] 
            ],
            'VIP Suite' => [
                'descriptions' => [
                   'The room area is three square meters and contains two large beds'
                ],
                'prices' => [300, 350, 400], 
                'capacities' => [2, 4, 5] 
            ]

        ];
        $roomType=$this->faker->randomElement(array_keys($RoomData)); 
        $roomOtherInfo=$RoomData[$roomType];

        return [
            'name' => $roomType,
            'description' => implode(" ",$roomOtherInfo['descriptions']),
            'price' => $this->faker->randomElement($roomOtherInfo['prices']),
            'capacity' => $this->faker->randomElement($roomOtherInfo['capacities']),
        ];
    }
}
