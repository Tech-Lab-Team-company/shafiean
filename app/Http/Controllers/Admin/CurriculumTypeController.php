<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Curriculum\DeleteCurriculmRequest;
use App\Http\Requests\Curriculum\EditCurriculumRequest;
use App\Http\Requests\Curriculum\FetchCurriculumDetailsRequest;
use App\Http\Requests\CurriculumType\DeleteCurriculumTypeRequest;
use App\Http\Requests\CurriculumType\FetchCurriculumTypeDetailsRequest;
use App\Http\Requests\CurriculumType\FetchCurriculumTypeRequest;
use App\Http\Requests\CurriculumType\StoreCurriculumTypeRequest;
use App\Http\Requests\CurriculumType\UpdateCurriculumTypeRequest;
use App\Services\CurriculumTypeService;
use Illuminate\Http\Request;

class CurriculumTypeController extends Controller
{
    protected $curriculumTypeService;

    public function __construct(CurriculumTypeService $curriculumTypeService)
    {
        $this->curriculumTypeService = $curriculumTypeService;
    }

    public function index(FetchCurriculumTypeRequest $request)
    {
        return $this->curriculumTypeService->getAllCurriculumTypes($request)->response();
    }

    public function store(StoreCurriculumTypeRequest $request)
    {
        return $this->curriculumTypeService->createCurriculumType($request)->response();
    }

    public function show(FetchCurriculumTypeDetailsRequest $request)
    {
        return $this->curriculumTypeService->getCurriculumTypeById($request)->response();
    }

    public function update(UpdateCurriculumTypeRequest $request)
    {
        return $this->curriculumTypeService->updateCurriculumType($request)->response();
    }

    public function destroy(DeleteCurriculumTypeRequest $request)
    {
        return $this->curriculumTypeService->deleteCurriculumType($request)->response();
    }

}
