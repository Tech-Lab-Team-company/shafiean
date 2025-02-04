<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Global\AccountSettingsService;
use App\Http\Requests\Teacher\AccountSettings\TeacherAccountSettingsRequest;
use App\Http\Requests\Teacher\AccountSettings\TeacherAccountSettingsPasswordRequest;

class TeacherAccountSettingsController extends Controller
{
    protected $user;
    public function __construct(protected AccountSettingsService $accountSettingsService)
    {
        $this->middleware('auth:organization');
        $this->user = Auth::guard('organization')->user();
    }
    public function fetchAccountSettings()
    {
        return $this->accountSettingsService->fetchAccountSettings($this->user)->response();
    }
    public function updateAccountSettings(TeacherAccountSettingsRequest $request)
    {
        return $this->accountSettingsService->updateAccountSettings($this->user, $request)->response();
    }
    public function changePassword(TeacherAccountSettingsPasswordRequest $request)
    {
        return $this->accountSettingsService->changePassword($this->user, $request)->response();
    }
}
