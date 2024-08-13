<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\DisabilityType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $city = City::inRandomOrder()->first();
        $disabilityType = DisabilityType::inRandomOrder()->first();
        $country = Country::inRandomOrder()->first();
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'password' => Hash::make('password'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'city_id' => City::inRandomOrder()->first()->id,
            'disability_type_id' => DisabilityType::inRandomOrder()->first()->id,
            'country_id' => Country::inRandomOrder()->first()->id,
            'api_key' => Str::random(32),
            'image' => $this->faker->imageUrl,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
