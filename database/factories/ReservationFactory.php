<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\Service;
use App\Models\RoomType;
use App\Http\Traits\ApiReservationTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{   use ApiReservationTrait;
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

    public function definition(): array
    {
        
        $user_ids=User::pluck('id')->toArray();
        $user_id=$this->faker->randomElement($user_ids);
        $room_ids=Room::pluck('id')->toArray();
        $room_id=$this->faker->randomElement($room_ids);
        $roomPrice=Room::firstWhere('id',$room_id)->price;
        $startDate = $this->faker->dateTimeBetween('-1 week', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, Carbon::parse($startDate)->addWeek()->toDateTime());
        $days = Carbon::parse($endDate)->diffInDays(Carbon::parse($startDate));
        $totalPrice = $roomPrice * $days;
        return [
            'user_id'=>$user_id,
            'room_id'=>$room_id,
            'code'=>$this->faker->randomElement($this->generateRandomStrings(6)),
            'start_date'=>$startDate,
            'end_date'=>$endDate,
            'guestNumber'=>$this->faker->randomNumber(1,2),
            'totalPrice'=>$totalPrice,

        ];
    }
}
