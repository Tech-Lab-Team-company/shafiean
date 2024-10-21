<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserCheckEmailService;
use App\Http\Requests\User\Auth\UserCheckEmailRequest;

class UserCheckEmailController extends Controller
{
    public function __construct(protected UserCheckEmailService $userCheckEmailService) {}

    public function __invoke(UserCheckEmailRequest $request)
    {
        return $this->userCheckEmailService->checkEmail($request)->response();
    }
}
