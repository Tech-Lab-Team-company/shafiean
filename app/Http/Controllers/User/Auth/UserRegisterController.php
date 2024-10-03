<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserRegisterService;
use App\Http\Requests\User\Auth\UserRegisterRequest;

class UserRegisterController extends Controller
{
    public function __construct(protected UserRegisterService $userRegisterService) {}
    public function __invoke(UserRegisterRequest $request)
    {
        return $this->userRegisterService->register($request)->response();
    }
}
