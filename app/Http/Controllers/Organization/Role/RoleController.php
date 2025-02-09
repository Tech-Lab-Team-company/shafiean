<?php

namespace App\Http\Controllers\Organization\Role;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Role\RoleService;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService) {}
    public function store(Request $request)
    {
        return $this->roleService->store($request)->response();
    }
}
