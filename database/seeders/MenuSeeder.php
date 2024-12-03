<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'parent_id' => null, // Root menu
                'name' => 'Dashboard',
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null, // Root menu
                'name' => 'Settings',
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 2, // Child of 'Settings'
                'name' => 'Profile',
                'position' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => 2, // Child of 'Settings'
                'name' => 'Security',
                'position' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'parent_id' => null, // Root menu
                'name' => 'Analytics',
                'position' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
