<?php

namespace App\Http\Controllers;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

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
        return $this->userService->getAllUsers()->response();

    }

    public function store(UserStoreRequest $request)
    {
        return $this->userService->createUser($request->validated())->response();
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return new UserResource($user);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        return $this->userService->updateUser($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->userService->deleteUser($id)->response();

    }
}


