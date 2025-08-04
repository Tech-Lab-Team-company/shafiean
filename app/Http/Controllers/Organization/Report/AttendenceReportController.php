<?php

namespace App\Http\Controllers\Organization\Report;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\AttendenceReport\AddMutipleReportsRequest;
use App\Http\Requests\Organization\AttendenceReport\AddSingleReportRequest;
use App\Http\Requests\Organization\AttendenceReport\DeleteReportRequest;
use App\Http\Requests\Organization\AttendenceReport\EditReportRequest;
use App\Http\Requests\Organization\AttendenceReport\FetchReportDetailsRequest;
use App\Http\Requests\Organization\AttendenceReport\FetchReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Organization\Report\AttendenceReportService;

class AttendenceReportController extends Controller
{

    public function __construct(protected AttendenceReportService $reportService) {}

    public function index(FetchReportRequest $request)
    {
        $auth = Auth::guard('organization')->user();
        return $this->reportService->index($request,  $auth)->response();
    }

    /**
     * Store a newly created session in the storage.
     *
     * @param AddSingleReportRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSingleReportRequest $request)
    {
        return $this->reportService->create($request)->response();
    }
    
    public function storeMultiple(AddMutipleReportsRequest $request)
    {
        return $this->reportService->createMutiple($request)->response();
    }

    public function show(FetchReportDetailsRequest $request)
    {
        return $this->reportService->getDetails($request)->response();
    }

    public function update(EditReportRequest $request)
    {
        // return $this->reportService->update($request)->response();
    }

    public function destroy(DeleteReportRequest $request)
    {
        return $this->reportService->delete($request)->response();
    }

    // public function changeActiveStatus(ChangeReportActiveStatusRequest $request)
    // {
    //     return $this->reportService->changeActiveStatus($request)->response();
    // }
}
