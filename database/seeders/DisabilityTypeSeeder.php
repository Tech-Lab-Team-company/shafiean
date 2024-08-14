<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DisabilityType;

class DisabilityTypeSeeder extends Seeder
{
    public function run()
    {
        // Optionally truncate the table if you want to start fresh
        // DB::table('disability_types')->truncate();

        // Seed the table with dummy data
        DisabilityType::factory()->count(10)->create(); // Creates 10 disability types
    }
}

