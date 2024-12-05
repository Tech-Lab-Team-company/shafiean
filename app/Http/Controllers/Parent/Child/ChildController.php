<?php

namespace App\Http\Controllers\Parent\Child;

use App\Http\Controllers\Controller;
use App\Services\Parent\ChildService;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    protected $childService;

    public function __construct(ChildService $childService)
    {
        $this->childService = $childService;
    }
    public function academic_report(Request $request)
    {
        return $this->childService->academic_report($request)->response();
    }
    public function exam_report(Request $request)
    {
        return $this->childService->exam_report($request)->response();
    }
    public function littleExamReport(Request $request)
    {
        return $this->childService->littleExamReport($request)->response();
    }

    public function session_attendance_report(Request $request)
    {
        return $this->childService->session_attendance_report($request)->response();
    }
    public function parentChildren()
    {
        return $this->childService->parentChildren()->response();
    }
}
