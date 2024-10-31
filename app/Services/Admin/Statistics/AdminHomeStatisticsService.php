<?php

namespace App\Services\Admin\Statistics;

use Exception;
use App\Models\User;
use App\Models\Country;
use App\Models\Teacher;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Answer\Answer;
use App\Http\Resources\Organization\Answer\AnswerResource;
use App\Http\Resources\Admin\Statistics\AdminHomeStatisticResource;
use App\Http\Resources\Admin\Statistics\Count\AdminHomeCountStatisticResource;
use App\Http\Resources\Admin\Statistics\Student\LatestStudentStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\MostActiveOrganizationStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\StatisticMostActiveOrganizationResource;
use App\Http\Resources\Admin\Statistics\Organization\StatisticMostActiveOrganizationCollection;
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
                message: 'fetch Count Statistics successfully'
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
            $latestStudents = User::latest()->take(3)->get();
            return new DataSuccess(
                data: LatestStudentStatisticResource::collection($latestStudents),
                status: true,
                message: 'fetch Latest Students Statistics successfully'
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
            $mostActiveOrganizations = Organization::withCount('users')->orderBy('users_count', 'desc')->take(3)->get();
            return new DataSuccess(
                data: MostActiveOrganizationStatisticResource::collection($mostActiveOrganizations),
                status: true,
                message: 'fetch Most Active Organizations Statistics successfully'
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
            // $organizations = Organization::withCount(['city', 'teachers', 'users'])->whereCountryId($dataRequest['country_id'])
            //     ->orderBy('city_count', 'desc')
            //     ->take(5)
            //     ->get();
            $organizations = Organization::where('country_id', $dataRequest['country_id'])
                ->with('city') // Assuming you have a relationship defined
                ->withCount(['teachers', 'users']) // Count the related teachers and users
                ->select('city_id')
                ->selectRaw('count(*) as total_organizations')
                ->groupBy('city_id')
                ->orderByDesc('total_organizations')
                ->get();
            return new DataSuccess(
                data: BestPlacesInteractedWithOrganizationStatisticResource::collection($organizations),
                status: true,
                message: 'fetch Best Places Interacted With Organization Statistics successfully'
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
