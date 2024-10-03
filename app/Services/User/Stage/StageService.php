<?php

namespace App\Services\User\Stage;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\StageResource;
use App\Models\Stage;
use App\Services\Global\FilterService;

class StageService
{
    public function fetch_stages($request): DataStatus
    {
        try{
            $query = Stage::query();
            $filter_service = new FilterService();
            if ($request) {
                $filter_service->filterStage($request, $query);
            }
            $stages = $query->orderBy('id', 'desc')->paginate(10);
            // dd($stages);
            return new DataSuccess(
                data: StageResource::collection($stages)->response()->getData(true),
                status: true,
                message: 'Stages fetched successfully'
            );
        }catch(\Exception $e){
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}

