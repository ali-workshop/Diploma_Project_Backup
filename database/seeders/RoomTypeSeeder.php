<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create([
            'name'         => 'Standard Single Room',
            'price'        => '3',
            'capacity'     => '1',
            'description'  => 'The room area is two square meters and contains a small bed',
        ]);
        RoomType::create([
            'name'         => 'Standard Suite ',
            'price'        => '5',
            'capacity'     => '3',
            'description'  => 'The room area is two square meters and has a large bed',
        ]);
        RoomType::create([
            'name'         => 'VIP Single Room',
            'price'        => '5',
            'capacity'     => '2',
            'description'  => 'The room area is two square meters and contains two beds',
        ]);
        RoomType::create([
            'name'         => 'VIP Suite ',
            'price'        => '7',
            'capacity'     => '5',
            'description'  => 'The room area is three square meters and contains two large beds',
        ]);
    }
}
