<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quraan;

class QuraanSeeder extends Seeder
{
    public function run()
    {
        Quraan::factory()->count(10)->create();
    }
}
