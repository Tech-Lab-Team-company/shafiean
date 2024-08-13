<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
//            CitySeeder::class,
//            DisabilityTypeSeeder::class,
//            CountrySeeder::class,
//            UserSeeder::class,
//            AdminSeeder::class,
//            AdminHistorySeeder::class,
           // TeachersTableSeeder::class,
            OrganizationsTableSeeder::class
        ]);
    }
}

