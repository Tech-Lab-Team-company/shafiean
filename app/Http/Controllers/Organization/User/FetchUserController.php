<?php

namespace App\Http\Controllers\Organization\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\EndPoint\User\FetchUserService;

class FetchUserController extends Controller
{
    public function __construct(protected FetchUserService $fetchUserService) {}
    public function __invoke()
    {
        return $this->fetchUserService->fetchUsers()->response();
    }
}
