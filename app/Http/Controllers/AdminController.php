<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\AdminStoreRequest;
use App\Http\Requests\Admin\AdminUpdateRequest;
use App\Http\Resources\AdminResource;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        $admins = $this->adminService->getAll();
        return AdminResource::collection($admins);
    }

    public function store(AdminStoreRequest $request)
    {
        return $this->adminService->create($request->validated())->response();

    }

    public function show($id)
    {
        $admin = $this->adminService->getById($id);
        return new AdminResource($admin);
    }

    public function update(AdminUpdateRequest $request, $id)
    {
       return $this->adminService->update($id, $request->validated())->response();

    }

    public function destroy($id)
    {
        return $this->adminService->delete($id)->response();

    }
}

