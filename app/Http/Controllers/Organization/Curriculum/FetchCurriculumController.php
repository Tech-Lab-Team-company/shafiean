<?php

namespace App\Http\Controllers\Organization\Curriculum;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\Seanson\FetchSeasonService;
use App\Services\Organization\EndPoint\Curriculum\FetchCurriculumService;

class FetchCurriculumController extends Controller
{
    public function __construct(protected FetchCurriculumService $fetchCurriculumService) {}

    public function __invoke()
    {
        return $this->fetchCurriculumService->fetchCurriculum()->response();
    }
}
