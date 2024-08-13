<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DisabilityType;

class DisabilityTypeSeeder extends Seeder
{
    public function run()
    {
        DisabilityType::factory()->count(5)->create();
    }
}

