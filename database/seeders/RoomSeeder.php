<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Database\Factories\RoomFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    //  room_type_id,code,floorNumber,,description,img,status,price

    public function run(): void
    {
       Room::factory(5)->create();
    }
}
