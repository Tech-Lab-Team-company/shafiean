<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'country_id' => Country::factory(),
        ];
    }
}

