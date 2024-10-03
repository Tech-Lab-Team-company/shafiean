<?php

namespace App\Http\Controllers\User\Subscription;

use App\Http\Controllers\Controller;
use App\Services\User\Subscription\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    protected $subscription_service;

    public function __construct(SubscriptionService $subscription_service)
    {
        $this->subscription_service = $subscription_service;
    }

    public function subscripe_group($request) {
        return $this->subscription_service->subscripe_group($request)->response();
    }
}
