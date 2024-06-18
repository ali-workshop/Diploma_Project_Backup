<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use App\Models\Reservation;
>>>>>>> repoB/main
use App\Models\User;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
=======
        // Reservation::factory(10)->create();
>>>>>>> repoB/main
        //  User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@example.com',
        // ]);
        //$this->call(RoleSeeder::class);
        //$this->call(AdminSeeder::class);
        //$this->call(ContactSeeder::class);

        // $this->call(RoleSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(ContactSeeder::class);
        // $this->call(MessageSeeder::class);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ContactSeeder::class,
            MessageSeeder::class,
            ServicesSeeder::class,
            RoomTypeSeeder::class,
<<<<<<< HEAD
            RoomSeeder::class,
            RoomTypeServiceSeeder::class,
=======
            RoomTypeServiceSeeder::class,
            RoomSeeder::class,
>>>>>>> repoB/main
            ReservationStatusCatlogSeeder::class,
            ReservationSeeder::class,
            ReservationStatusEventSeeder::class,

        ]);
    }
}

