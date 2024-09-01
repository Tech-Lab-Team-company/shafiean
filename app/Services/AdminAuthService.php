<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthService
{

    public function login($request)
    {
        // Extract the credentials
        $credentials = $request->only('email', 'password');
        try {
            // Retrieve the admin using the email address
            $admin = Admin::where('email', $credentials['email'])->first();

            // Check if the admin exists and if the password matches
            if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
                return new DataFailed(
                    message: 'The provided credentials are incorrect.',
                    status: false,
                    statusCode: 401
                );
            }

            // If the credentials are correct, create a token
            $token = $admin->createToken($request->email)->plainTextToken;

            // Prepare the response with the admin data and token
            $response = [
                'admin' => new AdminResource($admin),
                'token' => $token,
            ];

            // Return a success response
            return new DataSuccess(
                status: true,
                data: $response,
                message: 'Login successful',
            );
        } catch (\Exception $exception) {
            // Return a failed response in case of an exception
            return new DataFailed(
                message: $exception->getMessage(),
                status: false,
                statusCode: 401
            );
        }
    }

    public function logout(): DataStatus
    {
        try {
            $admin = Auth::guard('admin')->user();
            if ($admin) {
                $admin->tokens()->delete();
            }
            return new DataSuccess(
                status: true,
                message: 'Admin logout successful'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Logout failed: ' . $e->getMessage()
            );
        }
    }

    public function changePassword($request): DataStatus
    {
        try {
            $admin = Auth::guard('admin')->user();
            // dd($admin);
            // dd(!Hash::check($request->old_password, $admin->password));
            if (!Hash::check($request->old_password, $admin->password)) {
                return new DataFailed(
                    status: false,
                    message: 'Current password is incorrect'
                );
            }
            $admin->update([
                'new_password' => Hash::make($request->password)
            ]);


            return new DataSuccess(
                status: true,
                message: 'Admin password changed successfully'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                status: false,
                message: 'Admin password change failed: ' . $e->getMessage()
            );
        }
    }
}
