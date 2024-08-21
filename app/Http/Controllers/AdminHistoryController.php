<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\AdminHistoryRequest;
use App\Http\Resources\AdminHistoryResource;
use App\Services\AdminHistoryService;

class AdminHistoryController extends Controller
{
    protected $adminHistoryService;

    public function __construct(AdminHistoryService $adminHistoryService)
    {
        $this->adminHistoryService = $adminHistoryService;
    }

    public function index()
    {
        return $this->adminHistoryService->getAll()->response();

    }

    public function store(AdminHistoryRequest $request)
    {
        return $this->adminHistoryService->create($request->validated())->response();

    }

    public function show($id)
    {
        $adminHistory = $this->adminHistoryService->getById($id);
        return new AdminHistoryResource($adminHistory);
    }

    public function update(AdminHistoryRequest $request, $id)
    {
        return $this->adminHistoryService->update($id, $request->validated())->response();

    }

    public function destroy($id)
    {
        return $this->adminHistoryService->delete($id)->response();

    }
}


