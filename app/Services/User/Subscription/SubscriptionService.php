<?php

namespace App\Services\User\Subscription;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Subscription;
use App\Models\Teacher;
use App\Models\User;

class SubscriptionService
{
    public function subscripe_group($request): DataStatus
    {
        try {
            $data['user_id'] = $request->user_id;
            $data['group_id'] = $request->group_id;
            $data['course_id'] = $request->course_id;
            $data['creatable_type'] = Teacher::class;
            $data['creatable_id'] = auth()->user()->id;

            $subscription = Subscription::create($data);

            return new DataSuccess(
                status: true,
                data: $subscription
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
