<?php

namespace Database\Factories;

use App\Models\CurriculumDisabilityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumDisabilityTypeFactory extends Factory
{
    protected $model = CurriculumDisabilityType::class;

    public function definition()
    {
        return [
            'disability_type_id' => \App\Models\DisabilityType::factory(),
            'curriculum_id' => \App\Models\Curriculum::factory(),
        ];
    }
}
