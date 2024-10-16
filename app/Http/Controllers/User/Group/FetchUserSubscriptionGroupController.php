<?php

namespace App\Http\Controllers\User\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\User\EndPoint\Group\FetchUserSubscriptionGroupService;

class FetchUserSubscriptionGroupController extends Controller
{
    public function __construct(protected FetchUserSubscriptionGroupService $fetchUserSubscriptionGroupService) {}
    public function __invoke()
    {
        return $this->fetchUserSubscriptionGroupService->fetchUserSubscriptionGroup()->response();
    }
}
