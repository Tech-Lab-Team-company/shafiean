<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'licence_number' => $this->faker->unique()->numerify('LIC#######'),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->companyEmail,
            'address' => $this->faker->address,
            'country_id' => null, // You can set a specific value or relate it to a Country factory
            'city_id' => null, // You can set a specific value or relate it to a City factory
            'manager_name' => $this->faker->name,
            'manager_phone' => $this->faker->phoneNumber,
            'manager_email' => $this->faker->unique()->safeEmail,
        ];
    }
}

