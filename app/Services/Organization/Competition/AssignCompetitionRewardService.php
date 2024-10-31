<?php

namespace App\Services\Organization\Competition;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Competition\CompetitionReward;
use App\Http\Resources\Organization\CompetitionReward\CompetitionRewardResource;
use App\Http\Resources\Organization\CompetitionReward\CompetitionRewardUserResource;

class AssignCompetitionRewardService
{
    public function assignUser($dataRequest): DataStatus
    {
        try {
            $competitionReward = CompetitionReward::whereId($dataRequest->competition_reward_id)->first();
            if (!$competitionReward) {
                return new DataFailed(
                    status: false,
                    message: 'Competition Reward not found'
                );
            }
            $competitionReward->update([
                'user_id' => $dataRequest->user_id
            ]);
            return new DataSuccess(
                status: true,
                data: new CompetitionRewardUserResource($competitionReward),
                message: 'Competition Reward Assign Successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
