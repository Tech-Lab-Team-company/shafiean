<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Curriculum\CurriculumRequest;
use App\Http\Requests\Organization\AddCurriculumRequest;
use App\Http\Requests\Organization\ChangeCirruclumActiveStatusRequest;
use App\Http\Requests\Organization\DeleteCurriculmRequest;
use App\Http\Requests\Organization\EditCurriculumRequest;
use App\Http\Requests\Organization\FetchCurriculumDetailsRequest;
use App\Http\Resources\CurriculumResource;
use App\Services\CurriculumService;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    protected $curriculumService;

    public function __construct(CurriculumService $curriculumService)
    {
        $this->curriculumService = $curriculumService;
    }

    public function index(CurriculumRequest $request)
    {
        return $this->curriculumService->getAllCurriculums($request)->response();
    }

    public function store(AddCurriculumRequest $request)
    {
        return $this->curriculumService->createCurriculum($request)->response();
    }

    public function show(FetchCurriculumDetailsRequest $request)
    {
        return $this->curriculumService->getCurriculumById($request)->response();
    }

    public function update(EditCurriculumRequest $request)
    {
        return $this->curriculumService->updateCurriculum($request)->response();
    }

    public function destroy(DeleteCurriculmRequest $request)
    {
        return $this->curriculumService->deleteCurriculum($request)->response();
    }

    public function  changeActiveStatus(ChangeCirruclumActiveStatusRequest $request)
    {
        return $this->curriculumService->changeActiveStatus($request)->response();
    }
}
