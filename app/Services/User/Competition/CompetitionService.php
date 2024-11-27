<?php

namespace App\Services\User\Competition;

use Carbon\Carbon;
use App\Enum\CompetitionPeriodEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Competition\Competition;
use App\Http\Resources\Organization\Competition\CompetitionResource;

class CompetitionService
{

    public function fetch_competitions($dataRequest): DataStatus
    {
        try {
            $competitions = Competition::query();
            $now = Carbon::now();
            $competitions->when($dataRequest->period, function ($query) use ($dataRequest, $now) {
                if ($dataRequest->period == CompetitionPeriodEnum::CURRENT->value) {
                    $query->where('start_date', '<=', $now->format('Y-m-d'))->where('end_date', '>=', $now->format('Y-m-d'));
                } elseif ($dataRequest->period == CompetitionPeriodEnum::NEXT->value) {
                    $query->where('start_date', '>', $now->format('Y-m-d'));
                }
            });
            $competitions = $competitions->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                status: true,
                data: CompetitionResource::collection($competitions)->response()->getData(true),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function fetch_competition_details($dataRequest): DataStatus
    {
        try {
            $competition = Competition::find($dataRequest->competition_id);
            return new DataSuccess(
                status: true,
                data: new CompetitionResource($competition),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function join_competition($dataRequest): DataStatus
    {
        try {
            // dd($dataRequest->competition_id);
            $competition = Competition::find($dataRequest->competition_id);
            // dd($competition);
            $competition->users()->sync(auth()->guard('user')->user()->id);
            return new DataSuccess(
                status: true,
                message: 'joined successfully'
                // data: new CompetitionResource($competition),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
