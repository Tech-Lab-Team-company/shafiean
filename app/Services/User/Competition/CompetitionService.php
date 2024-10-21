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
            $competitions->when($dataRequest->period, function ($query) use ($dataRequest) {
                if ($dataRequest->period == CompetitionPeriodEnum::CURRENT->value) {
                    $query->whereBetween('start_date', [
                        Carbon::now()->startOfDay()->format('Y-m-d'),
                        Carbon::now()->addDays(1)->endOfDay()->format('Y-m-d')
                    ]);
                } elseif ($dataRequest->period == CompetitionPeriodEnum::NEXT->value) {
                    $query->where('start_date', '>=', Carbon::now()->addDays(2)->startOfDay()->format('Y-m-d'));
                }
            });
            $competitions = $competitions->paginate(10);
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
}
