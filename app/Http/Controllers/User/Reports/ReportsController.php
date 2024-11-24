<?php

namespace App\Http\Controllers\User\Reports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Reports\ReportsService;

class ReportsController extends Controller
{
    public function __construct(protected ReportsService $reportsService) {}
    public function competitionReport(Request $request)
    {
        return $this->reportsService->competitionReport($request)->response();
    }

    public function attendanceAndDepartureReport(Request $request)
    {
        return $this->reportsService->AttendanceAndDepartureReport($request)->response();
    }
    public function examReport(Request $request)
    {
        return $this->reportsService->examReport($request)->response();
    }
    public function academyReport(Request $request)
    {
        return $this->reportsService->academyReport($request)->response();
    }
}
