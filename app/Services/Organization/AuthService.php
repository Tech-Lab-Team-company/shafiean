<?php

namespace App\Services\Organization;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\OrganizationEmployeeResource;
use App\Models\Organization;
use App\Models\Teacher;
use App\Services\Global\CodeService;
use App\Services\Global\EmailService;
use App\Services\Global\PasswordService;
use Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login($request): DataStatus
    {
        try {
            $employee = Teacher::where('email', $request->email)->first();

            if (!$employee) {
                return new DataFailed(
                    status: false,
                    message: 'wrong email'
                );
            }

            if (!Hash::check($request->password, $employee->password)) {
                return new DataFailed(
                    status: false,
                    message: 'wrong password'
                );
            }
            // If the credentials are correct, create a token
            $token = $employee->createToken($request->email)->plainTextToken;
            $response = [
                'employee' => new OrganizationEmployeeResource($employee),
                'token' => $token,
            ];
            // dd($response);
            return new DataSuccess(
                status: true,
                data: $response,
                message: 'Login successful',
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
                message: 'Logout successful',
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
                    message: 'wrong email'
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
