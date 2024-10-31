<?php

namespace App\Services\Organization\EndPoint\User;


use Exception;
use App\Models\User;
use App\Models\Season;
use App\Enum\UserTypeEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Season\FetchSeasonResource;
use App\Http\Resources\Organization\EndPoint\Student\FetchStudentResource;

class FetchUserService
{
    public function fetchUsers()
    {
        try {
            $users = User::get();
            return new DataSuccess(
                data: FetchStudentResource::collection($users),
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
