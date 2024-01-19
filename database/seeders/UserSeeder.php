<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'kopihtspardede@gmail.com',
            'password' => bcrypt('HTSPardede')
        ])->assignRole('Administrator');

        // User::create([
        //     'name' => 'User',
        //     'username' => 'user',
        //     'email' => 'user@gmail.com',
        //     'password' => bcrypt('password')
        // ])->assignRole('User');
    }
}
