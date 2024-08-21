<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quraan\QuraanRequest;
use App\Http\Resources\QuraanResource;
use App\Services\QuraanService;

class QuraanController extends Controller
{
    protected QuraanService $quraanService;

    public function __construct(QuraanService $quraanService)
    {
        $this->quraanService = $quraanService;
    }

    public function index()
    {
        return $this->quraanService->getAllQuraans()->response();

    }

    public function store(QuraanRequest $request)
    {
        return $this->quraanService->createQuraan($request->validated())->response();
    }

    public function show($id)
    {
        $quraan = $this->quraanService->getQuraanById($id);
        return new QuraanResource($quraan);
    }

    public function update(QuraanRequest $request, $id)
    {
        return $this->quraanService->updateQuraan($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->quraanService->deleteQuraan($id)->response();
    }
}
