<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\Statistics\AdminStatisticsService;
use App\Services\Admin\Statistics\AdminHomeStatisticsService;
use App\Http\Requests\Admin\Statistics\fetchBestPlacesInteractedWithOrganizationRequest;

class AdminHomeStatisticController extends Controller
{
    public function __construct(protected AdminHomeStatisticsService $adminHomeStatisticsService) {}
    public function fetchCounts()
    {
        return $this->adminHomeStatisticsService->fetchCounts()->response();
    }
    public function fetchLatestStudents()
    {
        return $this->adminHomeStatisticsService->fetchLatestStudents()->response();
    }
    public function fetchMostActiveOrganizations()
    {
        return $this->adminHomeStatisticsService->fetchMostActiveOrganizations()->response();
    }
    public function fetchBestPlacesInteractedWithOrganization(fetchBestPlacesInteractedWithOrganizationRequest $request)
    {
        return $this->adminHomeStatisticsService->fetchBestPlacesInteractedWithOrganization($request)->response();
    }
}
