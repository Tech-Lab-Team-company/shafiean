<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ayat;

class AyatSeeder extends Seeder
{
    public function run()
    {
        Ayat::factory()->count(20)->create();
    }
}

