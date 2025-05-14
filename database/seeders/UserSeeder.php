<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Hala hasan',
            'email' => 'hala.hasan@gmail.com',
            'role' => 'manager',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Eminem ',
            'email' => 'eminem@gmail.com',
            'role' => 'team-lead',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'name' => 'Michle Jackson',
            'email' => 'michle.jackson@gmail.com',
            'role' => 'member',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Halloush',
            'email' => 'halloush@gmail.com',
            'role' => 'member',
            'password' => Hash::make('password123')
        ]);

        User::create([
            'name' => 'Hasan has',
            'email' => 'hasan.has@gmail.com',
            'role' => 'team-lead',
            'password' => Hash::make('password123')
        ]);
    }
}

