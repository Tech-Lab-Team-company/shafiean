<?php

namespace App\Http\Controllers\Organization\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Statistics\OrganizationHomeStatisticsService;
use App\Http\Requests\Admin\Statistics\fetchBestPlacesInteractedWithOrganizationRequest;

class OrganizationHomeStatisticController extends Controller
{
    public function __construct(protected OrganizationHomeStatisticsService $organizationHomeStatisticsService) {}
    public function fetchCounts()
    {
        return $this->organizationHomeStatisticsService->fetchCounts()->response();
    }
    public function fetchLatestStudents()
    {
        return $this->organizationHomeStatisticsService->fetchLatestStudents()->response();
    }
    public function fetchMostActiveGroups()
    {
        return $this->organizationHomeStatisticsService->fetchMostActiveGroups()->response();
    }
    public function fetchBestPlacesInteractedWithOrganization(fetchBestPlacesInteractedWithOrganizationRequest $request)
    {
        return $this->organizationHomeStatisticsService->fetchBestPlacesInteractedWithOrganization($request)->response();
    }
    public function fetchInteractedRateWithOrganization()
    {
        return $this->organizationHomeStatisticsService->fetchInteractedRateWithOrganization()->response();
    }
}
