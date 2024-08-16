<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stage;

class StageSeeder extends Seeder
{
    public function run()
    {
        Stage::factory()->count(10)->create();
    }
}

