<?php

namespace App\Http\Controllers\Organization;

use App\Helpers\Response\DataSuccess;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Services\AuthService;
use App\Services\TeacherAuthService;
use Illuminate\Http\Request;

class TeacherAuthController extends Controller
{
    protected $teacherAuthService;

    public function __construct(TeacherAuthService $teacherAuthService){
        $this->teacherAuthService = $teacherAuthService;
    }

    public function login(AuthRequest $request)
    {
        return $this->teacherAuthService->login($request->validated())->response();
    }

    public function logout(Request $request)
    {
        return $this->teacherAuthService->logout()->response();
    }


}
