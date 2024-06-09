<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Service;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function generateRandomStrings($count) :array{
        $strings = [];
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        
        for ($i = 0; $i < $count; $i++) {
            $letter = $letters[rand(0, strlen($letters) - 1)];
            $number = $numbers[rand(0, strlen($numbers) - 1)];
            $strings[] = $letter . $number;
        }
        
        return $strings;
    }
     //    user_id,room_id,code,start_date,end_date,guestNumber,totalPrice
     
    public function definition(): array
    {
        
        $user_ids=User::pluck('id')->toArray();
        $user_id=$this->faker->randomElement($user_ids);
        $room_ids=Room::pluck('id')->toArray();
        $room_id=$this->faker->randomElement($room_ids);
        $roomPrice=Room::firstWhere('id',$room_id)->price;
        
        $roomType_ids=RoomType::pluck('id')->toArray();
        $roomType_id=$this->faker->randomElement($roomType_ids);
        $roomTypePrice=RoomType::firstWhere('id',$roomType_id)->price;

        $service_ids=Service::pluck('id')->toArray();
        $service_id=$this->faker->randomElement($service_ids);
        $servicePrice=Service::firstWhere('id',$service_id)->price;

        $totalPrice= $roomPrice+$roomTypePrice+$servicePrice;

        $start_date = Carbon::instance($this->faker->dateTimeBetween('-1 week', 'now'));
        $end_date = Carbon::instance($this->faker->dateTimeBetween($start_date, $start_date->copy()->addWeek()));
       
        return [
            'user_id'=>$user_id,
            'room_id'=>$room_id,
            'code'=>$this->faker->randomElement($this->generateRandomStrings(6)),
            'start_date'=>$start_date,
            'end_date'=>$end_date,
            'guestNumber'=>$this->faker->randomNumber(1,2),
            'totalPrice'=>$totalPrice,

        ];
    }
}
