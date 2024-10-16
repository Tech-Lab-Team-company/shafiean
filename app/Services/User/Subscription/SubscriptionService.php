<?php

namespace App\Services\User\Subscription;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Subscription;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\Organization\Subscription\SubscriptionResource;

class SubscriptionService
{
    public function  index(): DataStatus
    {
        try {
            $subscriptions = Subscription::get();

            return new DataSuccess(
                data: SubscriptionResource::collection($subscriptions)->response()->getData(true),
                status: true,
                message: 'Subscription fetched successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function store($request): DataStatus
    {
        try {
            foreach ($request['user_ids'] as $userId) {
                $data['user_id'] = $userId;
                $data['group_id'] = $request['group_id'];
                $data['course_id'] = $request['course_id'];
                $data['creatable_type'] = Teacher::class;
                $data['creatable_id'] = auth('organization')->user()->id;
                $subscription = Subscription::create($data);
            }
            return new DataSuccess(
                status: true,
                message: 'Subscription created successfully',
                data: new SubscriptionResource($subscription)
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
