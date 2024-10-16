<?php
namespace App\Services\User\EndPoint\Group;


use App\Helpers\Response\DataStatus;
use App\Models\Group;
use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\GroupResource;
use App\Http\Resources\User\EndPoint\Group\FetchUserSubscriptionGroupResource;

class FetchUserSubscriptionGroupService
{
    public function fetchUserSubscriptionGroup($userId): DataStatus
    {
        try {
            $subscriptions = Subscription::whereUserId($userId)->whereNotNull('group_id')->get()->pluck('group_id')->toArray();
            $groups = Group::whereIn('id', $subscriptions)->get();
            return new DataSuccess(
                status: true,
                message: 'Groups retrieved successfully',
                data: FetchUserSubscriptionGroupResource::collection($groups)->response()->getData(true),
            );
        } catch (\Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
