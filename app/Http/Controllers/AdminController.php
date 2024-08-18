<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
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

    public function store(AdminRequest $request)
    {
        return $this->adminService->create($request->validated())->response();

    }

    public function show($id)
    {
        $admin = $this->adminService->getById($id);
        return new AdminResource($admin);
    }

    public function update(AdminRequest $request, $id)
    {
       return $this->adminService->update($id, $request->validated())->response();

    }

    public function destroy($id)
    {
        return $this->adminService->delete($id)->response();

    }
}

