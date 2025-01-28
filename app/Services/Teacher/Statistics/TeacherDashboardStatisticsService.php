<?php

namespace App\Services\Teacher\Statistics;


use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Helpers\Response\DataFailed;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Admin\Statistics\Organization\InteractedRateWithOrganizationResource;

class TeacherDashboardStatisticsService
{

    public function siteStatisticsRate()
    {
        try {
            /** @var Teacher $teacher  */
            $teacher = Auth::guard('organization')->user();
            $sessionCount = DB::table('group_stage_sessions')
                ->join('teachers', 'group_stage_sessions.teacher_id', '=', 'teachers.id')
                ->where('teachers.id', $teacher->id)
                ->count('group_stage_sessions.id');
            $groupCount = DB::table('group_stage_sessions')
                ->join('groups', 'group_stage_sessions.group_id', '=', 'groups.id')
                ->where('group_stage_sessions.teacher_id', $teacher->id)
                ->distinct()
                ->count('group_stage_sessions.group_id');
            $userCount = DB::table('group_stage_sessions')
                ->join('user_groups', 'group_stage_sessions.group_id', '=', 'user_groups.group_id')
                ->where('group_stage_sessions.teacher_id', $teacher->id)
                ->distinct('user_groups.user_id')
                ->count('user_groups.user_id');
            $rateCount = DB::table('session_teacher_rates')
                ->join('teachers', 'session_teacher_rates.teacher_id', '=', 'teachers.id')
                ->where('teachers.id', $teacher->id)
                ->count('session_teacher_rates.id');
            return new DataSuccess(
                data: [
                    'session_count' => $sessionCount,
                    'group_count' => $groupCount,
                    'user_count' => $userCount,
                    'rate_count' => $rateCount
                ],
                status: true,
                message: 'site Statistics Rate successfully'
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
                message: 'fetch Interacted Rate With Organization Statistics successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    // $sessionCount = $teacher->sessions()->count();
    // $groupCount = $teacher->teacherGroups()->distinct('group_id')->count();
    // $groups = $teacher->teacherGroups()->distinct('group_id')->with('users')->get();
    // $userIds = $groups->flatMap(function ($group) {
    //     return $group->users->pluck('id');
    // })->unique();
    // $userCount = $userIds->count();
    // $rateCount = $teacher->teacherRates()->count();
}
