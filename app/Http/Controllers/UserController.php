<?php

namespace App\Http\Controllers;

use App\Helpers\Response\DataStatus;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

use Illuminate\Http\Request;

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
        $user = $this->userService->createUser($request->validated());
//        return new UserResource($user);

    }

    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return new UserResource($user);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->getUserById($id);
        $user = $this->userService->updateUser($user, $request->validated());
        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = $this->userService->getUserById($id);
        $this->userService->deleteUser($user);
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}

