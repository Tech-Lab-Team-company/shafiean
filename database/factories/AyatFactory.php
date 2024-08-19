<?php

namespace Database\Factories;

use App\Models\Ayat;
use App\Models\Quraan; // Make sure to import the Quraan model if you're using it
use Illuminate\Database\Eloquent\Factories\Factory;

class AyatFactory extends Factory
{
    protected $model = Ayat::class;

    public function definition()
    {
        return [
            'quraan_id' => Quraan::factory(),
            'number' => $this->faker->numberBetween(1, 100),
        ];
    }
}

