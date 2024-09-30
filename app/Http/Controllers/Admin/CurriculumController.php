<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Curriculum\AddCurriculumRequest;
use App\Http\Requests\Curriculum\ChangeCirruclumActiveStatusRequest;
use App\Http\Requests\Curriculum\DeleteCurriculmRequest;
use App\Http\Requests\Curriculum\EditCurriculumRequest;
use App\Http\Requests\Curriculum\FetchCurriculumDetailsRequest;
use App\Http\Requests\Curriculum\FetchCurriculumsRequest;


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

    public function index(FetchCurriculumsRequest $request)
    {
        return $this->curriculumService->getAllCurriculums($request)->response()->header('Access-Control-Allow-Origin', 'http://localhost:8080');
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
