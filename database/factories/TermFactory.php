<?php

namespace Database\Factories;

use App\Models\Term;
use Illuminate\Database\Eloquent\Factories\Factory;


class TermFactory extends Factory
{

    protected $model = Term::class;
    public function definition()
    {
        return [
            'timestamp' => $this->faker->dateTime,
            'type' => $this->faker->word,
            'order' => $this->faker->randomNumber(),
        ];
    }
}

