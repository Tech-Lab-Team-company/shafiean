<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminHistoryRequest;
use App\Http\Resources\AdminHistoryResource;
use App\Models\Admin\AdminHistory;
use App\Services\AdminHistoryService;
use Illuminate\Http\Response;

class AdminHistoryController extends Controller
{
    protected $adminHistoryService;

    public function __construct(AdminHistoryService $adminHistoryService)
    {
        $this->adminHistoryService = $adminHistoryService;
    }

    public function index()
    {
        return AdminHistoryResource::collection($this->adminHistoryService->getAll());
    }

    public function store(AdminHistoryRequest $request)
    {
        $adminHistory = $this->adminHistoryService->create($request->validated());
        return new AdminHistoryResource($adminHistory);
    }

    public function show($id)
    {
        $adminHistory = $this->adminHistoryService->getById($id);
        return new AdminHistoryResource($adminHistory);
    }

    public function update(AdminHistoryRequest $request, AdminHistory $adminHistory)
    {
        $updatedAdminHistory = $this->adminHistoryService->update($adminHistory, $request->validated());
        return new AdminHistoryResource($updatedAdminHistory);
    }

    public function destroy(AdminHistory $adminHistory)
    {
        $this->adminHistoryService->delete($adminHistory);
        return new AdminHistoryResource($adminHistory);
    }
}

