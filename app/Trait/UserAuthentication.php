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
    public  function validatePassword(string $password, Model $row)
    {
        if (!Hash::check($password, $row->password)) {
            throw new \Exception(__('auth.credentials_incorrect'));
        }
    }
    public function getRow(string $email, string $model)
    {
        $row = $model::where('email', $email)->first();
        if (!$row) {
            throw new \Exception(__('auth.email_not_found'));
        }

        return $row;
    }
    public function checkVerified(Model $row){
        if (!$row->email_verified_at) {
            throw new \Exception(__('auth.email_not_verified'));
        }
    }
    public function generateSanctumToken(Model $row)
    {
        return sanctumApiToken($row, 'api');
    }

    public function generateApiToken(Model $row): void
    {
        if (!$row->api_token) {
            $row->update([
                'api_token' => hashApiToken(),
            ]);
        }
    }
    public function regenerateSanctumToken(Model $row)
    {
        $this->removeAllSanctumToken($row);
        return $this->generateSanctumToken($row);
    }
    public function removeApiToken($user): void
    {
        $user->update(['api_token' => null]);
    }
    public function removeAllSanctumToken(Model $model)
    {
        $model->tokens()->delete();
    }
    public function removeCurrentSanctumToken(Model $model)
    {
        $model->currentAccessToken()->delete();
    }
}
