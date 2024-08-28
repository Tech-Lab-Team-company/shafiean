<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;
    public function definition()
    {

        return [
            'name' => $this->faker->company,
            'licence_number' => $this->faker->unique()->numerify('LIC-####'),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
            'api_key' => Str::random(32),
            'web_key' => Str::random(32),
            'manager_name' => $this->faker->name,
            'manager_phone' => $this->faker->phoneNumber,
            'manager_email' => $this->faker->unique()->safeEmail,
        ];
    }
}


