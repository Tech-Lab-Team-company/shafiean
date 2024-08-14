<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::factory()->count(10)->create();
    }
}


