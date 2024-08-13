<?php

namespace Database\Factories;

use App\Models\DisabilityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DisabilityTypeFactory extends Factory
{
    protected $model = DisabilityType::class;

    public function definition()
    {
        return [
            'type' => $this->faker->word,

        ];
    }
}

