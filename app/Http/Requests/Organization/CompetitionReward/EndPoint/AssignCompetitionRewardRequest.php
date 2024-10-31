<?php

namespace App\Http\Requests\Organization\CompetitionReward\EndPoint;


use App\Enum\CompetitionStageEnum;
use App\Helpers\Response\ApiRequest;
use Illuminate\Foundation\Http\FormRequest;

class AssignCompetitionRewardRequest extends ApiRequest
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
            'competition_reward_id' => 'required|exists:competition_rewards,id',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
