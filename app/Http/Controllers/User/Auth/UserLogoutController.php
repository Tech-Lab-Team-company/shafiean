<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserLogoutService;

class UserLogoutController extends Controller
{
    public function __construct(protected UserLogoutService $userLogoutService) {}
    public function __invoke()
    {
        return $this->userLogoutService->logout()->response();
    }
}
