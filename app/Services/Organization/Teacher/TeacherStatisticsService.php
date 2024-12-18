<?php

namespace App\Services\Organization\Teacher;


use Exception;
use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Group;
use App\Models\Teacher;
use Carbon\CarbonPeriod;
use App\Enum\UserTypeEnum;
use App\Models\MainSession;
use App\Models\Organization;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Group\GroupTitleResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionResource;
use App\Http\Resources\Admin\Statistics\Student\LatestStudentStatisticResource;
use App\Http\Resources\Organization\Teacher\Statistics\Count\TeacherStatisticCountResource;
use App\Http\Resources\Admin\Statistics\Organization\InteractedRateWithOrganizationResource;
use App\Http\Resources\Organization\Statistics\Count\OrganizationHomeCountStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\MostActiveOrganizationGroupStatisticResource;
use App\Http\Resources\Admin\Statistics\Organization\BestPlacesInteractedWithOrganizationStatisticResource;

class TeacherStatisticsService
{
    public function fetchCounts()
    {
        try {
            $lessons = $this->lessonCount();
            $students = $this->studentCount();
            $groups = $this->groupCount();
            return new DataSuccess(
                data: new TeacherStatisticCountResource([
                    'lesson_count' => $lessons,
                    'student_count' => $students,
                    'group_count' => $groups,
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
    public function teacherGroup()
    {
        try {

            $groups = Group::whereTeacherId(Auth::guard('organization')->user()->id)->paginate(10);
            return new DataSuccess(
                data: GroupTitleResource::collection($groups)->response()->getData(true),
                status: true,
                message: 'fetch teacher group successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function fetchMainSessions($dataRequest)
    {
        try {
            $groupStageSessions =  Group::whereId($dataRequest->group_id)->first()->groupStageSessions()->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: FetchMainSessionResource::collection($groupStageSessions)->response()->getData(true),
                status: true,
                message: 'Main Session fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    private function studentCount()
    {
        return User::whereType(UserTypeEnum::STUDENT->value)->count();
    }

    private function lessonCount()
    {
        return Group::with('groupStageSessions')->get()->count();
    }
    private function groupCount()
    {
        return Group::whereTeacherId(Auth::user()->id)->count();
    }
    // public function fetchLatestStudents()
    // {
    //     try {
    //         $latestStudents = User::latest()->take(3)->orderBy('id', 'desc')->get();
    //         return new DataSuccess(
    //             data: LatestStudentStatisticResource::collection($latestStudents),
    //             status: true,
    //             message: 'fetch Latest Students Statistics successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }
    // public function fetchMostActiveGroups()
    // {
    //     try {
    //         $mostActiveGroups = Group::withCount('subscriptions')
    //             ->orderBy('subscriptions_count', 'desc')
    //             ->take(3)
    //             ->get(['id', 'name', 'subscriptions_count']);
    //         return new DataSuccess(
    //             data: MostActiveOrganizationGroupStatisticResource::collection($mostActiveGroups),
    //             status: true,
    //             message: 'fetch Most Active Organizations Statistics successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }
    // public function fetchBestPlacesInteractedWithOrganization($dataRequest)
    // {
    //     try {
    //         $cities =
    //             City::join('countries as co', 'cities.country_id', '=', 'co.id')
    //             ->join('organizations as org', 'org.city_id', '=', 'cities.id')
    //             ->leftJoin('teachers as t', 't.organization_id', '=', 'org.id')
    //             ->leftJoin('users as s', 's.organization_id', '=', 'org.id')
    //             ->select(
    //                 'cities.title as city_title',
    //                 DB::raw('COUNT(DISTINCT org.id) as organization_count'),
    //                 DB::raw('COUNT(DISTINCT t.id) as teacher_count'),
    //                 DB::raw('COUNT(DISTINCT s.id) as student_count')
    //             )
    //             ->where('co.id', $dataRequest->country_id)
    //             ->groupBy('cities.id', 'cities.title', 'cities.country_id')
    //             ->orderBy('organization_count', 'desc')
    //             ->limit(5)
    //             ->get();
    //         return new DataSuccess(
    //             data: BestPlacesInteractedWithOrganizationStatisticResource::collection($cities),
    //             status: true,
    //             message: 'fetch Best Places Interacted With Organization Statistics successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }
    // public function fetchInteractedRateWithOrganization()
    // {
    //     try {
    //         $startDate = Carbon::now()->subMonths(7)->startOfMonth();
    //         $endDate = Carbon::now()->subMonth()->endOfMonth();
    //         $period = CarbonPeriod::create($startDate, '1 month', $endDate);
    //         $months = [];
    //         $userCounts = [];
    //         foreach ($period as $date) {
    //             $months[] = $date->format('M');
    //             $userCounts[] =  User::whereMonth('created_at', $date->month)
    //                 ->whereYear('created_at', $date->year)
    //                 ->count();
    //         }
    //         return new DataSuccess(
    //             data: new InteractedRateWithOrganizationResource([
    //                 'months' => $months,
    //                 'user_counts' => $userCounts
    //             ]),
    //             status: true,
    //             message: 'fetch Interacted Rate With Organization Statistics successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }


}
