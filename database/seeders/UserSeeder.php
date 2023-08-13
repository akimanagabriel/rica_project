<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "john",
            "phone" => "0781341752",
            "email" => "janedoe@gmail.com",
            "username" => "john",
            "password" => "john",
        ]);
    }
}
