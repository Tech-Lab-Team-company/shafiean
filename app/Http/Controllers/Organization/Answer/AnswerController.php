<?php

namespace App\Http\Controllers\Organization\Answer;

use App\Http\Controllers\Controller;
use App\Services\Organization\Answer\AnswerService;
use App\Http\Requests\Organization\Answer\StoreAnswerRequest;
use App\Http\Requests\Organization\Answer\DeleteAnswerRequest;
use App\Http\Requests\Organization\Answer\UpdateAnswerRequest;
use App\Http\Requests\Organization\Answer\FetchAnswerDetailsRequest;

class AnswerController extends Controller
{
    public function __construct(protected  AnswerService $answerService) {}
    public function index()
    {
        return $this->answerService->index()->response();
    }
    public function show(FetchAnswerDetailsRequest $request)
    {
        return $this->answerService->show($request)->response();
    }
    public function store(StoreAnswerRequest $request)
    {
        return $this->answerService->store($request->validated())->response();
    }
    public function update(UpdateAnswerRequest $request)
    {
        return $this->answerService->update($request->validated())->response();
    }
    public function delete(DeleteAnswerRequest $request)
    {
        return $this->answerService->delete($request)->response();
    }
}
