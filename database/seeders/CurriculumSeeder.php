<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class CurriculumSeeder extends Seeder
{
    public function run()
    {
        Curriculum::factory()->count(10)->create();
    }
}

