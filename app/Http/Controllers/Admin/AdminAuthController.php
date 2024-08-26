<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Resources\AdminResource;
use App\Services\AdminAuthService;

class AdminAuthController extends Controller
{
    protected $adminAuthService;
    public function __construct(AdminAuthService $adminAuthService)
    {
        $this->adminAuthService = $adminAuthService;
    }
    public function login(AdminLoginRequest $request)
    {
        return $this->adminAuthService->login($request->validated())->response();
    }
    public function logout()
    {
        return $this->adminAuthService->logout()->response();

    }
}
