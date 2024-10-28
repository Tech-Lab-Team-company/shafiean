<?php

namespace App\Http\Controllers\User\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\User\Profile\UserProfileService;
use App\Http\Requests\User\Profile\UpdateUserProfileRequest;

class UserProfileController extends Controller
{
    public function __construct(protected UserProfileService $userProfileService) {}
    public function show()
    {
        return $this->userProfileService->show()->response();
    }
    public function update(UpdateUserProfileRequest $request)
    {
        return $this->userProfileService->update(dataRequest: $request)->response();
    }
}
