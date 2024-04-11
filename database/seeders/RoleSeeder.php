<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Role::insert([
            [
                'grp_name' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'grp_name' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'grp_name' => 'Guest',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
