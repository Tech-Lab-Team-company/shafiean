<?php

namespace App\Services\Organization\Competition;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Competition\CompetitionReward;
use App\Http\Resources\Organization\CompetitionReward\CompetitionRewardResource;

class CompetitionRewardService
{
    public function index()
    {
        try {
            $competitionRewards = CompetitionReward::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: CompetitionRewardResource::collection($competitionRewards)->response()->getData(true),
                status: true,
                message: 'CompetitionRewards fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function show($request)
    {
        $competitionReward = CompetitionReward::whereId($request->id)->first();
        return new DataSuccess(
            data: new CompetitionRewardResource($competitionReward),
            statusCode: 200,
            message: 'Fetch CompetitionReward successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $competitionReward = CompetitionReward::create($dataRequest);
            return new DataSuccess(
                data: new CompetitionRewardResource($competitionReward),
                status: true,
                message: 'CompetitionReward created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $competitionReward = CompetitionReward::whereId($dataRequest['id'])->first();
            unset($dataRequest['id']);
            $competitionReward->update($dataRequest);
            return new DataSuccess(
                data: new CompetitionRewardResource($competitionReward),
                status: true,
                message: 'CompetitionReward updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($request): DataStatus
    {
        try {
            CompetitionReward::whereId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'CompetitionReward deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'CompetitionReward deletion failed: ' . $e->getMessage()
            );
        }
    }
}
