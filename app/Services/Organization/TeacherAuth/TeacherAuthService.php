<?php

namespace App\Services\Organization\TeacherAuth;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\TeacherResource;
use App\Http\Resources\UserResource;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TeacherAuthService
{
    public function login($request)
    {
        try {
            $credentials = $request->only('email', 'password');
            $teacher = Teacher::where('email', $credentials['email'])->first();
            if (!$teacher || !Hash::check($credentials['password'], $teacher->password)) {
                throw ValidationException::withMessages([
                    'email' => [__('messages.email_or_password_incorrect')],
                ]);
            }
            Auth::login($teacher);
            $token = $teacher->createToken('teacher_token')->plainTextToken;
            return new DataSuccess(
                data: new TeacherResource($teacher, $token),
                statusCode: 200,
                message: __('messages.success_login')
            );
        } catch (\Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Login failed: ' . $e->getMessage()
            );
        }
    }

    public function logout(): DataStatus
    {
        try {
            DB::beginTransaction();
            $teacher = Auth::guard('teacher')->user();
            if ($teacher) {
                $teacher->tokens()->delete();
            }
            DB::commit();
            return new DataSuccess(
                message: __('messages.success_logout')
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return new DataFailed(
                message: $e->getMessage()
            );
        }
    }
}
