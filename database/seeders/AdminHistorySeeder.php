<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminHistory;

class AdminHistorySeeder extends Seeder
{
    public function run()
    {
        AdminHistory::factory()->count(20)->create(); // Adjust count as needed
    }
}

