<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data for days table
        $days = [
            ['day_of_week' => 0, 'title' => 'Sunday', 'created_at' => now(), 'updated_at' => now()],
            ['day_of_week' => 1, 'title' => 'Monday', 'created_at' => now(), 'updated_at' => now()],
            ['day_of_week' => 2, 'title' => 'Tuesday', 'created_at' => now(), 'updated_at' => now()],
            ['day_of_week' => 3, 'title' => 'Wednesday', 'created_at' => now(), 'updated_at' => now()],
            ['day_of_week' => 4, 'title' => 'Thursday', 'created_at' => now(), 'updated_at' => now()],
            ['day_of_week' => 5, 'title' => 'Friday', 'created_at' => now(), 'updated_at' => now()],
            ['day_of_week' => 6, 'title' => 'Saturday', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert data into the days table
        Day::insert($days);
    }
}
