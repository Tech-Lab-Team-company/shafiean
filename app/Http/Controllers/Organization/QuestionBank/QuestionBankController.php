<?php

namespace App\Http\Controllers\Organization\QuestionBank;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Organization\QuestionBank\QuestionBankService;
use App\Http\Requests\Organization\QuestionBank\StoreQuestionBankRequest;
use App\Http\Requests\Organization\QuestionBank\DeleteQuestionBankRequest;
use App\Http\Requests\Organization\QuestionBank\UpdateQuestionBankRequest;
use App\Http\Requests\Organization\QuestionBank\FetchQuestionBankDetailsRequest;

class QuestionBankController extends Controller
{
    public function __construct(protected  QuestionBankService $questionBankService) {}
    public function index(Request $request)
    {
        return $this->questionBankService->index($request)->response();
    }
    public function show(FetchQuestionBankDetailsRequest $request)
    {
        return $this->questionBankService->show($request)->response();
    }
    public function store(StoreQuestionBankRequest $request)
    {
        return $this->questionBankService->store($request->validated())->response();
    }
    public function update(UpdateQuestionBankRequest $request)
    {
        return $this->questionBankService->update($request->validated())->response();
    }
    public function delete(DeleteQuestionBankRequest $request)
    {
        return $this->questionBankService->delete($request)->response();
    }
}
