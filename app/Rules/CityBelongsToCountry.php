<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CityBelongsToCountry implements Rule
{

    public function __construct(protected $countryId) {}

    public function passes($attribute, $value)
    {
        return DB::table('cities')
            ->where('id', $value)
            ->where('country_id', $this->countryId)
            ->exists();
    }

    public function message()
    {
        return "المدينة لا توجد في الدولة المحددة";
    }
}
