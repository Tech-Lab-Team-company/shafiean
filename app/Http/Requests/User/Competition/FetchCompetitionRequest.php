<?php

namespace App\Http\Requests\User\Competition;


use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Enum\CompetitionPeriodEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchCompetitionRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'period' => 'nullable|in:' . enumCaseValue(CompetitionPeriodEnum::class),
        ];
    }
}
