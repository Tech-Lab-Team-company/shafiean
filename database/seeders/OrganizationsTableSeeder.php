<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationsTableSeeder extends Seeder
{
    public function run()
    {

        Organization::factory()->count(10)->create();
    }
}

