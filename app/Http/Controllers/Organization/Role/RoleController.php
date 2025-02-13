<?php

namespace App\Http\Controllers\Organization\Role;

use App\Http\Controllers\Controller;
use App\Services\Organization\Role\RoleService;
use App\Http\Requests\Organization\Role\Role\StoreRoleRequest;
use App\Http\Requests\Organization\Role\Role\DeleteRoleRequest;
use App\Http\Requests\Organization\Role\Role\UpdateRoleRequest;
use App\Http\Requests\Organization\Role\Role\FetchRoleDetailsRequest;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService) {}
    public function fetchRoles()
    {
        return $this->roleService->fetchRoles()->response();
    }
    public function fetchAllRoles()
    {
        return $this->roleService->fetchAllRoles()->response();
    }
    public function fetchRoleDetails(FetchRoleDetailsRequest $request)
    {
        return $this->roleService->fetchRoleDetails($request)->response();
    }
    public function store(StoreRoleRequest $request)
    {
        return $this->roleService->store($request)->response();
    }
    public function update(UpdateRoleRequest $request)
    {
        return $this->roleService->update($request)->response();
    }

    public function delete(DeleteRoleRequest $request)
    {
        return $this->roleService->delete($request)->response();
    }
}
