<?php

namespace Database\Factories;

use App\Models\Admin\AdminHistory;
use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminHistoryFactory extends Factory
{
    protected $model = AdminHistory::class;
    public function definition()
    {
        return [
            'admin_id' => Admin::factory(), // Link to a newly created Admin
            'creatable_type' => $this->faker->word,
            'editable_type' => $this->faker->word,
            'model_id' => $this->faker->randomNumber(),
            'type' => $this->faker->word,
            'order' => $this->faker->word,
        ];
    }
}
