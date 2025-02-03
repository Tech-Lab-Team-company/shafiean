<?php

namespace App\Services\Admin\Statistics;

use Exception;
use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Teacher;
use Carbon\CarbonPeriod;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Admin\Statistics\Count\AdminHomeCountStatisticResource;
use App\Http\Resources\Admin\Statistics\Student\LatestStudentStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\InteractedRateWithOrganizationResource;
// use App\Http\Resources\Admin\Statistics\Organization\MostActiveOrganizationStatisticResource;
use App\Http\Resources\Organization\Statistics\Organization\MostActiveOrganizationStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\BestPlacesInteractedWithOrganizationStatisticResource;

class AdminHomeStatisticsService
{
    public function fetchCounts()
    {
        try {
            $organizations = $this->organizationCount();
            $teachers = $this->teacherCount();
            $users = $this->userCount();

            return new DataSuccess(
                data: new AdminHomeCountStatisticResource([
                    'organization_count' => $organizations,
                    'teacher_count' => $teachers,
                    'user_count' => $users,
                ]),
                status: true,
                message:__('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchLatestStudents()
    {
        try {
            $latestStudents = User::latest()->take(3)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: LatestStudentStatisticResource::collection($latestStudents),
                status: true,
                message: __('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchMostActiveOrganizations()
    {
        try {
            $mostActiveOrganizations = Organization::withCount('users')->orderBy('users_count', 'desc')->take(3)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: MostActiveOrganizationStatisticResource::collection($mostActiveOrganizations),
                status: true,
                message: __('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchBestPlacesInteractedWithOrganization($dataRequest)
    {
        try {
            $cities =
                City::join('countries as co', 'cities.country_id', '=', 'co.id')
                ->join('organizations as org', 'org.city_id', '=', 'cities.id')
                ->leftJoin('teachers as t', 't.organization_id', '=', 'org.id')
                ->leftJoin('users as s', 's.organization_id', '=', 'org.id')
                ->select(
                    'cities.title as city_title',
                    DB::raw('COUNT(DISTINCT org.id) as organization_count'),
                    DB::raw('COUNT(DISTINCT t.id) as teacher_count'),
                    DB::raw('COUNT(DISTINCT s.id) as student_count')
                )
                ->where('co.id', $dataRequest->country_id)
                ->groupBy('cities.id', 'cities.title', 'cities.country_id')
                ->orderBy('organization_count', 'desc')
                ->limit(5)
                ->get();
            return new DataSuccess(
                data: BestPlacesInteractedWithOrganizationStatisticResource::collection($cities),
                status: true,
                message: __('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchInteractedRateWithOrganization()
    {
        try {
            $startDate = Carbon::now()->subMonths(7)->startOfMonth();
            $endDate = Carbon::now()->subMonth()->endOfMonth();
            $period = CarbonPeriod::create($startDate, '1 month', $endDate);
            $months = [];
            $userCounts = [];
            foreach ($period as $date) {
                $months[] = $date->format('M');
                $userCounts[] =  User::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count();
            }
            return new DataSuccess(
                data: new InteractedRateWithOrganizationResource([
                    'months' => $months,
                    'user_counts' => $userCounts
                ]),
                status: true,
                message:__('messages.success')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    private function organizationCount()
    {
        return Organization::count();
    }
    private function TeacherCount()
    {
        return Teacher::count();
    }
    private function userCount()
    {
        return User::count();
    }
}