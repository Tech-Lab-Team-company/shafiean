<?php

namespace App\Http\Controllers\Organization\Landingpage;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Landingpage\CommonQuestion\CommonQuestionService;
use App\Http\Requests\Organization\Landingpage\CommonQuestion\StoreCommonQuestionRequest;
use App\Http\Requests\Organization\Landingpage\CommonQuestion\DeleteCommonQuestionRequest;
use App\Http\Requests\Organization\Landingpage\CommonQuestion\UpdateCommonQuestionRequest;
use App\Http\Requests\Organization\Landingpage\CommonQuestion\FetchCommonQuestionDetailsRequest;

class CommonQuestionController extends Controller
{
    public function __construct(protected  CommonQuestionService $commonQuestionService) {}
    public function index()
    {
        return $this->commonQuestionService->index()->response();
    }
    public function show(FetchCommonQuestionDetailsRequest $request)
    {
        return $this->commonQuestionService->show($request)->response();
    }
    public function store(StoreCommonQuestionRequest $request)
    {
        return $this->commonQuestionService->store($request)->response();
    }
    public function update(UpdateCommonQuestionRequest $request)
    {
        return $this->commonQuestionService->update($request)->response();
    }
    public function delete(DeleteCommonQuestionRequest $request)
    {
        return $this->commonQuestionService->delete($request)->response();
    }
}
