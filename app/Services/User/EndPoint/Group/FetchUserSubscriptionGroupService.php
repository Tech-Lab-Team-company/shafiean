<?php
namespace App\Services\User\EndPoint\Group;


use App\Models\Group;
use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\GroupResource;
use App\Http\Resources\User\EndPoint\Group\FetchUserSubscriptionGroupResource;

class FetchUserSubscriptionGroupService
{
    public function fetchUserSubscriptionGroup()
    {
        try {
            $subscriptions = Subscription::whereUserId(authUser()->id)->get()->pluck('group_id')->toArray();
            $groups = Group::whereIn('id', $subscriptions)->get();
            return new DataSuccess(
                status: true,
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
