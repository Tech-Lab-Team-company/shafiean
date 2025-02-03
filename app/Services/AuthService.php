<?php

namespace App\Services;

use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataSuccess;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $credentials)
    {
        try {
            $user = User::where('email', $credentials['email'])->first();
            if (!$user || Hash::check($credentials['password'], $user->password)) {
                throw ValidationException::withMessages([
                    'email' => [__('messages.email_or_password_incorrect')],
                ]);
            }
            Auth::login($user);
            $token = $user->createToken('user_token')->plainTextToken;
            return new DataSuccess(
                data: new UserResource($user, $token),
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

    public function logout()
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();
        }

        return new DataSuccess(
            statusCode: 200,
            message: __('messages.success_logout')
        );
    }
}
