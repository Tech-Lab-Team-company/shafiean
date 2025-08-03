<?php

namespace App\Http\Controllers\Organization\Report;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Report\AddReportRequest;
use App\Http\Requests\Organization\Report\DeleteReportRequest;
use App\Http\Requests\Organization\Report\EditReportRequest;
use App\Http\Requests\Organization\Report\FetchReportDetailsRequest;
use App\Http\Requests\Organization\Report\FetchReportRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\Organization\Report\ReportService;

class ReportController extends Controller
{

    public function __construct(protected ReportService $reportService) {}

    public function index(FetchReportRequest $request)
    {
        $auth = Auth::guard('organization')->user();
        return $this->reportService->index($request,  $auth)->response();
    }

    /**
     * Store a newly created session in the storage.
     *
     * @param AddReportRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddReportRequest $request)
    {
        return $this->reportService->create($request)->response();
    }

    public function show(FetchReportDetailsRequest $request)
    {
        return $this->reportService->getDetails($request)->response();
    }

    public function update(EditReportRequest $request)
    {
        return $this->reportService->update($request)->response();
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
