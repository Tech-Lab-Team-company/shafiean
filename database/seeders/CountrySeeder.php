<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        Country::factory(10)->create();
        DB::table('countries')->insert([
            ['id' => 11, 'title' => 'Some Country Name'],

        ]);
    }
}

