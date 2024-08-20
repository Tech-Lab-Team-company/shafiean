<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return UserResource::collection($users);
    }

    public function store(UserRequest $request)
    {
        return $this->userService->createUser($request->validated())->response();
    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return new UserResource($user);
    }

    public function update(UserRequest $request, $id)
    {
        return $this->userService->updateUser($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->userService->deleteUser($id)->response();

    }
}


