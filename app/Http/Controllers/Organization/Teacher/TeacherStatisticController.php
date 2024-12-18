<?php

namespace App\Http\Controllers\Organization\Teacher;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Organization\Teacher\TeacherStatisticsService;
use App\Http\Requests\Organization\MainSession\FetchMainSessionRequest;
use App\Http\Requests\Admin\Statistics\fetchBestPlacesInteractedWithOrganizationRequest;

class TeacherStatisticController extends Controller
{
    public function __construct(protected TeacherStatisticsService $teacherStatisticsService) {}
    public function fetchCounts()
    {
        return $this->teacherStatisticsService->fetchCounts()->response();
    }
    public function teacherGroup()
    {
        return $this->teacherStatisticsService->teacherGroup()->response();
    }
    public function fetchMainSessions(FetchMainSessionRequest $request)
    {
        return $this->teacherStatisticsService->fetchMainSessions($request)->response();
    }
}
