<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Resources\UserResource;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\FetchUserDetailsRequest;

class UserController extends Controller
{
    use HasApiTokens, Notifiable;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->index()->response();
    }

    public function store(StoreUserRequest $request)
    {
        return $this->userService->store($request->validated())->response();
    }

    public function show(FetchUserDetailsRequest $request)
    {
        return $this->userService->show($request)->response();
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->userService->update($request->validated())->response();
    }

    public function delete(DeleteUserRequest $request)
    {
        return $this->userService->delete($request)->response();
    }
}
