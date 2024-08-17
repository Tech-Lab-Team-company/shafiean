<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculumRequest;
use App\Http\Resources\CurriculumResource;
use App\Services\CurriculumService;
use Illuminate\Http\Response;

class CurriculumController extends Controller
{
    protected $curriculumService;

    public function __construct(CurriculumService $curriculumService)
    {
        $this->curriculumService = $curriculumService;
    }

    public function index()
    {
        $curriculums = $this->curriculumService->getAllCurriculums();
        return CurriculumResource::collection($curriculums);
    }

    public function store(CurriculumRequest $request)
    {
        $curriculum = $this->curriculumService->createCurriculum($request->validated());
        return new CurriculumResource($curriculum);
    }

    public function show($id)
    {
        $curriculum = $this->curriculumService->getCurriculumById($id);
        return new CurriculumResource($curriculum);
    }

    public function update(CurriculumRequest $request, $id)
    {
        $curriculum = $this->curriculumService->updateCurriculum($id, $request->validated());
        return new CurriculumResource($curriculum);
    }

    public function destroy($id)
    {
        $this->curriculumService->deleteCurriculum($id);
        return response()->json(['message' => 'curriculum deleted successfully.'], 200);
    }
}

