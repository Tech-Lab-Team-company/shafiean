<?php

namespace App\Http\Controllers\User\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Subscription\SubscriptionService;
use App\Http\Requests\Organization\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Organization\Subscription\DeleteSubscriptionRequest;
use App\Http\Requests\Organization\Subscription\UpdateSubscriptionRequest;
use App\Http\Requests\Organization\Subscription\FetchSubscriptionDetailsRequest;

class SubscriptionController extends Controller
{

    public function __construct(protected SubscriptionService $subscriptionService) {}
    public function index()
    {
        return $this->subscriptionService->index()->response();
    }
    public function show(FetchSubscriptionDetailsRequest $request)
    {
        return $this->subscriptionService->show($request)->response();
    }
    public function store(StoreSubscriptionRequest $request)
    {
        return $this->subscriptionService->store($request->validated())->response();
    }
    public function delete(DeleteSubscriptionRequest $request)
    {
        return $this->subscriptionService->delete($request)->response();
    }
}
