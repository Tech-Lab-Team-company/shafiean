<?php

namespace App\Http\Controllers\User\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Subscription\SubscriptionService;
use App\Http\Requests\Organization\Subscription\StoreSubscriptionRequest;

class SubscriptionController extends Controller
{

    public function __construct(protected SubscriptionService $subscriptionService) {}

    public function store(StoreSubscriptionRequest $request)
    {
        return $this->subscriptionService->store($request->validated())->response();
    }
}
