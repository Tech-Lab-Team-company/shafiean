<?php

namespace App\Http\Controllers\Organization\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Reports\ReportsService;

class ReportsController extends Controller
{
    public function __construct(protected ReportsService $reportsService){}
    public function competitionReport(Request $request){
        return $this->reportsService->competitionReport()->response();

    }
}
