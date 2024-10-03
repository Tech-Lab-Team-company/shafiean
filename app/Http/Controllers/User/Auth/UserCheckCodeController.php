<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Auth\UserCheckCodeService;
use App\Http\Requests\User\Auth\UserCheckCodeRequest;

class UserCheckCodeController extends Controller
{
    public function __construct(protected UserCheckCodeService $userCheckCodeService) {}

    public function __invoke(UserCheckCodeRequest $request)
    {
        return $this->userCheckCodeService->checkCode($request)->response();
    }
}
