<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserDetails;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserDetails::create([
                'first_name' => "admin",
                'last_name' => "user",
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'phone_number' => '1234567890',
                'password' => Hash::make('Admin@1234')
            ]
        );

        UserDetails::create([
                'first_name' => "manager",
                'last_name' => "user",
                'name' => 'Manager',
                'email' => 'manager@test.com',
                'phone_number' => '1234567890',
                'password' => Hash::make('Manager@1234')
            ],
        );
    }
}
