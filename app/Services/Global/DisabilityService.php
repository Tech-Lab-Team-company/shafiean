<?php

namespace App\Services\Global;

use Exception;
use App\Models\Stage;
use App\Models\DisabilityType;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\DisabilityTypeResource;
use App\Http\Resources\DisabilityTypeTitleResource;

class DisabilityService
{

    public function fetach_disabilities(): DataStatus
    {
        try {
            $disabilities = DisabilityType::get();

            return new DataSuccess(
                status: true,
                data: DisabilityTypeResource::collection($disabilities),
                message: __('messages.success')
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function fetchDisabilityByStageIds($dataRequest): DataStatus
    {
        try {
            $stages = Stage::whereIn('id', $dataRequest->stage_ids)->with('disabilityTypes')->get();
            $disabilities = $stages->flatMap(function ($stage) {
                return $stage->disabilityTypes;
            })->unique('id');
            return new DataSuccess(
                status: true,
                data: DisabilityTypeTitleResource::collection($disabilities),
                message: __('messages.success')
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}