<?php

namespace App\Http\Requests\User\Competition;


use App\Enum\UserTypeEnum;
use App\Enum\IdentityTypeEnum;
use App\Enum\CompetitionPeriodEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class FetchCompetitionDetailRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'competition_id' => 'required|exists:competitions,id',
        ];
    }
}
