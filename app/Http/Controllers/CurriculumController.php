<?php

namespace App\Http\Controllers;

use App\Http\Requests\Curriculum\CurriculumRequest;
use App\Http\Resources\CurriculumResource;
use App\Services\CurriculumService;

class CurriculumController extends Controller
{
    protected $curriculumService;

    public function __construct(CurriculumService $curriculumService)
    {
        $this->curriculumService = $curriculumService;
    }

    public function index()
    {
       return $this->curriculumService->getAllCurriculums()->response();

    }

    public function store(CurriculumRequest $request)
    {
        return $this->curriculumService->createCurriculum($request->validated())->response();
    }

    public function show($id)
    {
        $curriculum = $this->curriculumService->getCurriculumById($id);
        return new CurriculumResource($curriculum);
    }

    public function update(CurriculumRequest $request, $id)
    {
        return $this->curriculumService->updateCurriculum($id, $request->validated())->response();
    }

    public function destroy($id)
    {
        return $this->curriculumService->deleteCurriculum($id)->response();
    }
}
