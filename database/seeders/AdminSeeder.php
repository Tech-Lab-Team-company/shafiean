<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '123123123',
                'is_master' => 1
            ]
        );
        // Admin::factory()->count(10)->create();
    }
}


