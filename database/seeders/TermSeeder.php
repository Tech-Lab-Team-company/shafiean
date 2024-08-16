<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class TermSeeder extends Seeder
{
    public function run()
    {
        Term::factory()->count(10)->create();
    }
}

