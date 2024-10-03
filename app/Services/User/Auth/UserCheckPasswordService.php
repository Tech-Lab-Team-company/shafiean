<?php

namespace App\Services\User\Auth;
use App\Trait\UserAuthentication;

class UserCheckPasswordService
{
    use UserAuthentication;
    public function checkCode($dataRequest) {}
}
