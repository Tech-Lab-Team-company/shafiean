<?php

namespace Database\Factories;

use App\Models\Quraan;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuraanFactory extends Factory
{
    protected $model = Quraan::class;
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'order' => $this->faker->word,
            'type' => $this->faker->word,
        ];
    }
}

