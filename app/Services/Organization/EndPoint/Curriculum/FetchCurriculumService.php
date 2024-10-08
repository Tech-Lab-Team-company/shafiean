<?php

namespace App\Services\Organization\EndPoint\Curriculum;


use Exception;
use App\Models\Season;
use App\Models\Curriculum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Curriculum\FetchCurriculumResource;

class FetchCurriculumService
{
    public function fetchCurriculum()
    {
        try {
            $curriculums = Curriculum::get();
            return new DataSuccess(
                data: FetchCurriculumResource::collection($curriculums),
                status: true,
                message: 'Curriculums fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
