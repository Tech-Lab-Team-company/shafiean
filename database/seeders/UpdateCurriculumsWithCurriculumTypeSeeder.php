<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;
use App\Enum\CurriculumTypeEnum;

class UpdateCurriculumsWithCurriculumTypeSeeder extends Seeder
{
    public function run(): void
    {

        foreach (Curriculum::all() as $curriculum) {
            if (isset($curriculum->type) && CurriculumTypeEnum::from($curriculum->type) != null ) {
                $curriculum->curriculum_type_id = $curriculum->type;
                $curriculum->save();
            }
        }
    }
}
