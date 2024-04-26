<?php

namespace Database\Seeders;

use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

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
                'us_email'              => 'mini@secondlife.com',
                'password'              => Hash::make('Minyons123_'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Jakarta',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_ADMIN,
                'us_name'               => 'Admin',
                'us_username'           => 'admins',
                'us_email'              => 'admin@secondlife.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Jakarta',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_GUEST,
                'us_name'               => 'Guest',
                'us_username'           => 'guest',
                'us_email'              => 'guest@secondlife.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Bekasi',
                'us_province'           => 'Jawa Barat',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Rara',
                'us_username'           => 'rara',
                'us_email'              => 'rara@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Medan',
                'us_province'           => 'Sumatera Utara',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Jiji',
                'us_username'           => 'jiji',
                'us_email'              => 'jiji@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Medan',
                'us_province'           => 'Sumatera Utara',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Wini',
                'us_username'           => 'wini',
                'us_email'              => 'wini@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Jakarta',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Ocha',
                'us_username'           => 'ocha',
                'us_email'              => 'ocha@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Jakarta Utara',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Zizi',
                'us_username'           => 'zizi',
                'us_email'              => 'zizi@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Kota Jakarta Utara',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Kupa',
                'us_username'           => 'kupa',
                'us_email'              => 'kupa@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Jakarta Utara',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
            [
                'role_id'               => Roles::ROLE_USER,
                'us_name'               => 'Zoro',
                'us_username'           => 'zoro',
                'us_email'              => 'zoro@example.com',
                'password'              => Hash::make('Minyons123.'),
                'password_updated_at'   => now(),
                'us_DOB'                => '2003-01-01',
                'us_gender'             => 'Female',
                'us_city'               => 'Kota Jakarta Pusat',
                'us_province'           => 'DKI Jakarta',
                'created_at'            => now(),
                'updated_at'            => now(),
            ],
        ]);
    }
}
