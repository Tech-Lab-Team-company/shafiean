<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // AdminSeeder::class,
            // UserSeeder::class,
            // CountrySeeder::class,
            // CitySeeder::class,
            // DisabilityTypeSeeder::class,
            // AdminHistorySeeder::class,
            // OrganizationSeeder::class,
            // // TeacherSeeder::class,
            // CurriculumSeeder::class,
            // StageSeeder::class,
            // // TermSeeder::class,
            // OrganizationDisabilityTypeSeeder::class,
            // CurriculumDisabilityTypeSeeder::class,
            // QuraanSeeder::class,
            // // AyatSeeder::class,
            // DaySeeder::class,
            BloodTypeTableSeeder::class,
        ]);
    }
}
