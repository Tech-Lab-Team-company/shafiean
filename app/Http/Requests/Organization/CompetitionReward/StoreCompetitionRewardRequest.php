<?php

namespace App\Http\Requests\Organization\CompetitionReward;

use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompetitionRewardRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'competition_id' => 'required|exists:competitions,id',
            'stage' => 'required',
            'reward' => 'required',
        ];
    }
}
