<?php

namespace App\Services\Organization\Subscription;


use Exception;
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
            // $subscriptions = Subscription::orderBy('id', 'desc')->paginate(10);
            $subscriptions = Subscription::whereHas('group', function ($query): void {})
                ->with('group')
                ->orderBy('id', 'desc')
                ->paginate(10);
            return new DataSuccess(
                data: SubscriptionResource::collection($subscriptions)->response()->getData(true),
                status: true,
                message: 'Subscription fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function show($request)
    {
        $subscription = Subscription::whereId($request->id)->first();
        return new DataSuccess(
            data: new SubscriptionResource($subscription),
            statusCode: 200,
            message: 'Fetch Subscription successfully'
        );
    }
    public function store($request): DataStatus
    {
        try {
            /**
             * TODO
             * if course end date is less than today then show error message that course is expired ya 7omsa 
             * add disability_type_id to user based on course of the group
             */
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
                message: __('messages.success_create'),
                data: new SubscriptionResource($subscription)
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($request): DataStatus
    {
        try {
            Subscription::whereUserId($request->id)->first()->delete();
            return new DataSuccess(
                statusCode: 200,
                message: __('messages.success_delete')
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Subscription deletion failed: ' . $e->getMessage()
            );
        }
    }
}
