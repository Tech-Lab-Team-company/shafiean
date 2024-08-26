<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthService
{

    public function login(array $credentials)
    {
        try {
            $admin = Admin::where('email', $credentials['email'])->first();
            if (!$admin || Hash::check($credentials['password'], $admin->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }
            Auth::login($admin);
            $token = $admin->createToken('admin_token')->plainTextToken;

            return new DataSuccess(
                data: new AdminResource($admin, $token),
                statusCode: 200,
                message: 'Login successful'
            );
        }
         catch (\Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Login failed: ' . $e->getMessage()
            );
        }
    }

    public function logout()
    {
        try {
            $admin = Auth::guard('admin')->user();
            if ($admin) {
                $admin->tokens()->delete();
            }
            return new DataSuccess(
                statusCode: 200,
                message: 'Admin logout successful'
            );
        } catch (\Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Logout failed: ' . $e->getMessage()
            );
        }
    }
}

