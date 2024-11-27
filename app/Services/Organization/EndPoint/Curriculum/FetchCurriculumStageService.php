<?php

namespace App\Services\Organization\EndPoint\Curriculum;



use Exception;
use App\Models\Stage;
use App\Models\Season;
use App\Models\Curriculum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Curriculum\FetchCurriculumResource;
use App\Http\Resources\Organization\EndPoint\Curriculum\FetchCurriculumStageResource;

class FetchCurriculumStageService
{
    public function fetchCurriculumStage($request)
    {
        try {
            $stages = Stage::whereCurriculumId($request->curriculum_id)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: FetchCurriculumStageResource::collection($stages),
                status: true,
                message: 'CurriculumStage Fetched Successfully ^_^'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
