<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\AdminHistory;

class AdminHistorySeeder extends Seeder
{
    public function run()
    {
        AdminHistory::factory()->count(10)->create();
    }
}
