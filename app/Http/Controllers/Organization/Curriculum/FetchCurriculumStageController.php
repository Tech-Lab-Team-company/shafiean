<?php

namespace App\Http\Controllers\Organization\Curriculum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Curriculum\FetchCurriculumStageRequest;
use App\Services\Organization\EndPoint\Curriculum\FetchCurriculumStageService;

class FetchCurriculumStageController extends Controller
{
    public function __construct(protected FetchCurriculumStageService $fetchCurriculumStageService) {}

    public function __invoke(FetchCurriculumStageRequest $request)
    {
        return $this->fetchCurriculumStageService->fetchCurriculumStage($request)->response();
    }
}
