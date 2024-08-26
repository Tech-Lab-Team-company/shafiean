<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'api_key' => Str::random(60),
            'age' => $this->faker->numberBetween(25, 60),
            'image' => $this->faker->imageUrl(640, 480, 'people', true),
            'organization_id' => \App\Models\Organization::factory(),
            'is_employed' => $this->faker->boolean(),
        ];
    }
}

