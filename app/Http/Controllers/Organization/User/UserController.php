<?php

namespace App\Http\Controllers\Organization\User;


use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Organization\User\UserService;
use App\Http\Requests\User\FetchUserDetailsRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use HasApiTokens, Notifiable;
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        return $this->userService->index($request)->response();
    }

    public function store(AddUserRequest $request)
    {
        return $this->userService->store($request)->response();
    }

    public function show(FetchUserDetailsRequest $request)
    {
        return $this->userService->show($request)->response();
    }

    public function update(UpdateUserRequest $request)
    {
        return $this->userService->update($request)->response();
    }

    public function delete(DeleteUserRequest $request)
    {
        return $this->userService->delete($request)->response();
    }
    public function deleteUserImage(DeleteUserRequest $request)
    {
        return $this->userService->deleteUserImage($request)->response();
    }
}
