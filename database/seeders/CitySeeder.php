<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run()
    {
        DB::table('cities')->insert([
            ['title' => 'Vinnie ', 'country_id' => 1],
            ['title' => 'Vinnie Ha', 'country_id' => 2],
            ['title' => 'Vinnie Har', 'country_id' => 3],
            ['title' => 'Vinnie Harb', 'country_id' => 4],
            ['title' => 'Vinnie Harber', 'country_id' => 11],

        ]);

        //City::factory()->count(10)->create();
    }
}

