<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            DisabilityTypeSeeder::class,
            AdminSeeder::class,
            AdminHistorySeeder::class,
        ]);
    }
}

