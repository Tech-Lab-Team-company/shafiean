<?php

namespace App\Trait;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

trait UserAuthentication
{
    public function getAuthenticatedUser($guard): ?Model
    {
        return  Auth::guard($guard)->user();
    }
    public function generateSanctumToken(Model $row)
    {
        return sanctumApiToken($row, 'api');
    }
    protected function generateApiToken(Model $row): void
    {
        if (!$row->api_token) {
            $row->update([
                'api_token' => hashApiToken(),
            ]);
        }
    }
    public function removeApiToken($user): void
    {
        $user->update(['api_token' => null]);
    }
    protected function getRow(string $email, string $model)
    {
        $row = $model::where('email', $email)->first();
        if (!$row) {
            throw new \Exception(__('auth.email_not_found'));
        }

        return $row;
    }
    protected  function validatePassword(string $password, Model $row)
    {
        if (!Hash::check($password, $row->password)) {
            throw new \Exception(__('auth.credentials_incorrect'));
        }
    }
}
