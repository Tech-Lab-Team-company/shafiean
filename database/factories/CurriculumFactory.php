<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumFactory extends Factory
{
    protected $model = \App\Models\Curriculum::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'type' => $this->faker->numberBetween(1, 10),
            'time' => $this->faker->word,
            'from' => $this->faker->date,
            'to' => $this->faker->date,
            'order' => $this->faker->word,
            'curriculum_id' => $this->faker->optional()->numberBetween(1, 10),
        ];
    }
}

