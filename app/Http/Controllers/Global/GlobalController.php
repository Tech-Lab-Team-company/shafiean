<?php

namespace App\Http\Controllers\Global;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Global\GlobalService;
use App\Http\Requests\Organization\Exam\EndPoint\FetchExamStudentRequest;

class GlobalController extends Controller
{
    protected $global_service;


    public function __construct(GlobalService $globalService)
    {
        $this->global_service = $globalService;
    }

    public function fetch_days(Request $request)
    {
        dd(Auth::user());
        return $this->global_service->fetch_days($request)->response();
    }
    public function fetch_exam_students(FetchExamStudentRequest $request)
    {
        return $this->global_service->fetch_exam_students($request)->response();
    }
    public function fetch_years()
    {
        return $this->global_service->fetchYears()->response();
    }
}
