<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    public function run()
    {
        Teacher::create(
            [
                'name' => 'Teacher 1',
                'email' => 'teacher@gmail.com',
                'password' => bcrypt('123123123'),
                'organization_id' => 1,
            ]
        );
        Teacher::factory()->count(10)->create();
    }
}

