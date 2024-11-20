<?php
namespace App\Http\Controllers\User\Reports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Reports\ReportsService;

class ReportsController extends Controller
{
    public function __construct(protected ReportsService $reportsService){}
    public function competitionReport(Request $request){
        return $this->reportsService->competitionReport()->response();

    }
    public function AttendanceAndDepartureReport(Request $request){
        return $this->reportsService->AttendanceAndDepartureReport()->response();

    }
}
