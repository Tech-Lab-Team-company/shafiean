<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CurriculumType;
use App\Enum\CurriculumTypeEnum;

class CurriculumTypeSeeder extends Seeder
{
    public function run(): void
    {
        $descriptions = [
            CurriculumTypeEnum::QURAN->value           => 'منهج يهتم بتعليم القرآن الكريم، تلاوةً وتفسيراً وحفظاً.',
            CurriculumTypeEnum::FIQH->value            => 'يتناول فقه العبادات والمعاملات وأحكام الشريعة الإسلامية.',
            CurriculumTypeEnum::HADITH->value          => 'يعنى بتعليم أحاديث النبي ﷺ وفهمها وتحليلها.',
            CurriculumTypeEnum::ISLAMIC_SCIENCE->value => 'يشمل العقيدة، السيرة، علوم القرآن، وأصول الفقه وغيرها من العلوم الإسلامية.',
        ];

        foreach (CurriculumTypeEnum::cases() as $case) {
            CurriculumType::updateOrCreate(
                ['id' => $case->value],
                [
                    'name'        => ucfirst(str_replace('_', ' ', strtolower($case->name))),
                    'description' => $descriptions[$case->value],
                    'slug'        => $case->name, 
                ]
            );
        }
    }
}

