<?php

namespace App\Services\Organization\Auth;

use Exception;
use App\Models\Teacher;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Services\Global\CodeService;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\EmailService;
use App\Services\Global\PasswordService;
use App\Http\Resources\OrganizationEmployeeResource;

class AuthService
{
    public function login($request): DataStatus
    {
        try {
            $employee = Teacher::where('email', $request->email)->first();

            if (!$employee) {
                return new DataFailed(
                    status: false,
                    message: __('messages.email_not_found')
                );
            }

            if (!Hash::check($request->password, $employee->password)) {
                return new DataFailed(
                    status: false,
                    message: __('messages.wrong_password')
                );
            }
            $token = $employee->createToken($request->email)->plainTextToken;
            $response = [
                'token' => $token,
                'employee' => new OrganizationEmployeeResource($employee),
            ];
            return new DataSuccess(
                status: true,
                data: $response,
                message: __('messages.success_login'),
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function logout(): DataStatus
    {
        try {
            auth()->user()->currentAccessToken()->delete();
            return new DataSuccess(
                status: true,
                message: __('messages.success_logout'),
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function checkEmail($request): DataStatus
    {
        try {
            $employee = Teacher::where('email', $request->email)->first();
            if (!$employee) {
                return new DataFailed(
                    status: false,
                    message: __('messages.email_not_found')
                );
            }
            $email_service = new EmailService();
            $response = $email_service->checkEmail($employee)->response()->getData();
            return new DataSuccess(
                status: true,
                data: true,
                message: $response->message
            );
        } catch (Exception $exception) {

            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function checkCode($request): DataStatus
    {
        try {
            $employee = Teacher::where('email', $request->email)->first();
            $code_service = new CodeService();
            $response = $code_service->checkCode($request, $employee)->response()->getData();
            if (!$response->status) {
                return new DataSuccess(
                    status: false,
                    data: false,
                    message: $response->message
                );
            }
            return new DataSuccess(
                status: true,
                data: true,
                message: $response->message
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
    public function resetPasswordcheckCode($request): DataStatus
    {
        try {
            $employee = Teacher::where('email', $request->email)->first();
            $code_service = new CodeService();
            $response = $code_service->resetPasswordcheckCode($request, $employee)->response()->getData();
            if (!$response->status) {
                return new DataSuccess(
                    status: false,
                    data: false,
                    message: $response->message
                );
            }
            return new DataSuccess(
                status: true,
                data: true,
                message: $response->message
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function resetPassword($request): DataStatus
    {
        try {
            $employee = Teacher::where('email', $request->email)->first();
            $password_service = new PasswordService();
            $response = $password_service->resetPassword($request, $employee)->response()->getData();
            return new DataSuccess(
                status: true,
                message: $response->message
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }

    public function changePassword($request): DataStatus
    {
        try {
            $employee = auth()->guard('organization')->user();
            $password_service = new PasswordService();
            $response = $password_service->changePassword($request, $employee)->response()->getData();
            return new DataSuccess(
                status: true,
                message: $response->message
            );
        } catch (Exception $exception) {
            return new DataFailed(
                status: false,
                message: $exception->getMessage()
            );
        }
    }
}
