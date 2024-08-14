<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CitySeeder::class,
            DisabilityTypeSeeder::class,
            CountrySeeder::class,

            AdminSeeder::class,
            AdminHistorySeeder::class,
            TeachersTableSeeder::class,
            OrganizationsTableSeeder::class,
            CurriculumSeeder::class,

        ]);
    }
}

