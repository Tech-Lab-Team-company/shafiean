<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create(
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123123123'),
            ]
        );
        User::factory(10)->create();
    }
}

