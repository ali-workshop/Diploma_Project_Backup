<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Single Bed',
            'price'=> '50.00',
            'description' => 'A simple single bed for one person.',
            'img' => 'services/SingleBed.jpg',
        ]);
        Service::create([
            'name' => 'Double Bed',
            'price'=> '100.00',
            'description' => 'A comfortable double bed for two person.',
            'img' => 'services/DoubleBed.jpg',
        ]);
        Service::create([
            'name' => 'King-size Bed',
            'price'=> '200.00',
            'description' => 'Luxery experience',
            'img' => 'services/KingSizeBed.jpg',
        ]);
        Service::create([
            'name' => 'TV',
            'price'=> '30.00',
            'description' => 'Full access to all channels',
            'img' => 'services/TV.jpg',
        ]);
        Service::create([
            'name' => 'Fitness Center',
            'price'=> '100.00',
            'description' => 'A Fitness Center offers modern equipment. Availabe 24/7',
            'img' => 'services/FitnessCenter.png',
        ]);
        Service::create([
            'name' => 'Outdoor Swimming Pool',
            'price'=> '300.00',
            'description' => 'An Outdoor Swimming Pool offers refreshing swims, sun lounging, and poolside service.',
            'img' => 'services/OutdoorSwimmingPool.jpg',
        ]);
        Service::create([
            'name' => 'Indoor Swimming Pool',
            'price'=> '150.00',
            'description' => 'An Indoor Swimming Pool offers relaxation and fun.',
            'img' => 'services/IndoorSwimmingPool.jpg',
        ]);
        Service::create([
            'name' => 'Breakfast',
            'price'=> '150.00',
            'description' => 'Our hotel offers a diverse breakfast buffet with local and international delicacies.',
            'img' => 'services/Breakfast.jpg',
        ]);
        Service::create([
            'name' => 'Lunch',
            'price'=> '400.00',
            'description' => 'Our hotel offers a variety of delicious lunch options in a relaxing atmosphere.',
            'img' => 'services/Lunch.jpg',
        ]);
        Service::create([
            'name' => 'Dinner',
            'price'=> '500.00',
            'description' => 'Our hotel offers an exquisite dinner menu in a cozy, elegant dining environment.',
            'img' => 'services/Dinner.png',
        ]);
    }
}
