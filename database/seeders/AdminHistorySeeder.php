<?php

namespace Database\Seeders;

use App\Models\Admin\AdminHistory;
use Illuminate\Database\Seeder;

class AdminHistorySeeder extends Seeder
{
    public function run()
    {
        AdminHistory::factory()->count(10)->create();
    }
}

