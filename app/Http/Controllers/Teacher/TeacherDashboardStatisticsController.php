<?php

namespace App\Http\Controllers\Teacher;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Teacher\Statistics\TeacherDashboardStatisticsService;

class TeacherDashboardStatisticsController extends Controller
{
    public function __construct(protected TeacherDashboardStatisticsService $teacherDashboardStatisticsService) {}

    public function siteStatisticsRate()
    {
        return $this->teacherDashboardStatisticsService->siteStatisticsRate()->response();
    }
    public function fetchInteractedRateWithOrganization()
    {
        return $this->teacherDashboardStatisticsService->fetchInteractedRateWithOrganization()->response();
    }
}
