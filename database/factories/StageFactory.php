<?php

namespace Database\Factories;

use App\Models\Stage;
use Illuminate\Database\Eloquent\Factories\Factory;

class StageFactory extends Factory
{
    protected $model = Stage::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'type' => $this->faker->word,
            'order' => $this->faker->randomNumber(),
            'disability_type_id' => \App\Models\DisabilityType::factory(),
        ];
    }
}

