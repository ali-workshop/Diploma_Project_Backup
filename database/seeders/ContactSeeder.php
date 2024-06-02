<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'user_id'=>'1',
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'01234567'
        ]);
    }
}
