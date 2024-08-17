<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use App\Services\AdminService;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return AdminResource::collection($this->adminService->getAll());
    }

    public function store(AdminRequest $request)
    {
        $admin = $this->adminService->create($request->validated());
        return new AdminResource($admin);
    }

    public function show($id)
    {
        $admin = $this->adminService->getById($id);
        return new AdminResource($admin);
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        $updatedAdmin = $this->adminService->update($admin, $request->validated());
        return new AdminResource($updatedAdmin);
    }

    public function destroy(Admin $admin)
    {
        $this->adminService->delete($admin);
        return new AdminResource($admin);
    }
}
