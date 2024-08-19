<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationDisabilityType;

class OrganizationDisabilityTypeSeeder extends Seeder
{
    public function run()
    {
        OrganizationDisabilityType::factory()->count(10)->create();
    }
}

