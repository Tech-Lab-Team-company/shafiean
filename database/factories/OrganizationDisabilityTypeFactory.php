<?php

namespace Database\Factories;

use App\Models\OrganizationDisabilityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationDisabilityTypeFactory extends Factory
{
    protected $model = OrganizationDisabilityType::class;

    public function definition()
    {
        return [
            'organization_id' => \App\Models\Organization::factory(),
            'disability_type_id' => \App\Models\DisabilityType::factory(),
        ];
    }
}
