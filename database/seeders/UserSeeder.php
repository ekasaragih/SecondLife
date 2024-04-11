<?php

namespace Database\Seeders;

use App\Constants\Roles;
// use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Minyons',
                'us_username'           => 'dminyons',
                'us_email'                 => 'mini@secondlife.com',
                'us_password'              => Hash::make('12341234'),
                'password_updated_at'   => now(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_ADMIN,
                'us_name'               => 'Admin',
                'us_username'           => 'admins',
                'us_email'              => 'admin@secondlife.com',
                'us_password'           => Hash::make('12341234'),
                'password_updated_at'   => now(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
             [
                'role_id'               => Roles::ROLE_GUEST,
                'us_name'               => 'Guest',
                'us_username'           => 'guest',
                'us_email'              => 'guest@secondlife.com',
                'us_password'           => Hash::make('12341234'),
                'password_updated_at'   => now(),
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
        ]);
    }
}
