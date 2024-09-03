<?php

namespace Database\Factories;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumFactory extends Factory
{
    protected $model = Curriculum::class;
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'type' => $this->faker->numberBetween(1, 5),
           
        ];
    }
}

