<?php

namespace Database\Seeders;

use App\Models\User;
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
        //  User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@example.com',
        // ]);
<<<<<<< HEAD
        //$this->call(RoleSeeder::class);
        //$this->call(AdminSeeder::class);
        //$this->call(ContactSeeder::class);
=======
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
>>>>>>> 8a5a86fbb37074c588792b8e2d5364ca96145fa8
        $this->call(ContactSeeder::class);
        $this->call(MessageSeeder::class);
    }
}

