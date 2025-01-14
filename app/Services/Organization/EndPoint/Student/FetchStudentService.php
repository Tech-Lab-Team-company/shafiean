<?php

namespace App\Services\Organization\EndPoint\Student;

use Exception;
use App\Models\User;
use App\Models\Season;
use App\Enum\UserTypeEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Season\FetchSeasonResource;
use App\Http\Resources\Organization\EndPoint\Student\FetchStudentResource;
use App\Models\Subscription;

class FetchStudentService
{
    public function fetchUsers()
    {
        try {
            $subscriptionUserIds = Subscription::pluck('user_id')->toArray();
            $students = User::whereType(UserTypeEnum::STUDENT->value)->whereNotIn('id', $subscriptionUserIds)->orderBy('id', 'desc')->get();
            return new DataSuccess(
                data: FetchStudentResource::collection($students),
                status: true,
                message: 'Users fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
