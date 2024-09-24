<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodTypes = [
            ['title' => 'A+', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'A-', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'B+', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'B-', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'AB+', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'AB-', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'O+', 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'O-', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('blood_types')->insert($bloodTypes);
    }
}
