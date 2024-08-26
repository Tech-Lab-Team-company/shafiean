<?php

namespace Database\Factories;

use App\Models\DisabilityType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DisabilityTypeFactory extends Factory
{
    protected $model = DisabilityType::class;
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'order' => $this->faker->numberBetween(1, 10),

        ];
    }
}

