<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurriculumDisabilityType;

class CurriculumDisabilityTypeSeeder extends Seeder
{
    public function run()
    {
        CurriculumDisabilityType::factory()->count(10)->create();
    }
}
