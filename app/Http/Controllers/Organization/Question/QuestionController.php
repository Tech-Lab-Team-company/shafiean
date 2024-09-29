<?php

namespace App\Http\Controllers\Organization\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\Question\QuestionService;
use App\Http\Requests\Organization\Question\StoreQuestionRequest;
use App\Http\Requests\Organization\Question\DeleteQuestionRequest;
use App\Http\Requests\Organization\Question\UpdateQuestionRequest;
use App\Http\Requests\Organization\Question\FetchQuestionDetailsRequest;

class QuestionController extends Controller
{
    public function __construct(protected  QuestionService $questionService) {}
    public function index()
    {
        return $this->questionService->index()->response();
    }
    public function show(FetchQuestionDetailsRequest $request)
    {
        return $this->questionService->show($request)->response();
    }
    public function store(StoreQuestionRequest $request)
    {
        return $this->questionService->store($request->validated())->response();
    }
    public function update(UpdateQuestionRequest $request)
    {
        return $this->questionService->update($request->validated())->response();
    }
    public function delete(DeleteQuestionRequest $request)
    {
        return $this->questionService->delete($request)->response();
    }
}
