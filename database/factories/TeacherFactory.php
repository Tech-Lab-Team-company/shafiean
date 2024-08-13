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
            'password' => bcrypt('password'), // You may use Hash::make() as well
            'gender' => $this->faker->randomElement(['male', 'female']),
            'api_key' => Str::random(60),
            'age' => $this->faker->numberBetween(25, 60),
            'image' => $this->faker->imageUrl(640, 480, 'people'),
            'organazation_id' => null,
        ];
    }
}

