<?php

namespace App\Services\Organization\QuestionBank;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Services\Global\FilterService;
use App\Models\Organization\Question\Question;
use App\Models\Organization\Relation\Relation;
use App\Http\Resources\Organization\QuestionBank\QuestionBankResource;

class QuestionBankService
{
    public function index($dataRequest)
    {
        try {
            $query = Question::where('is_private', 0);
            $filter_service = new FilterService();
            if (isset($dataRequest)) {
                $filter_service->filterQuestions($query, $dataRequest);
            }
            $questions = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: QuestionBankResource::collection($questions)->response()->getData(true),
                status: true,
                message: 'Questions Bank fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function show($request)
    {
        $question = Question::where('is_private', 0)->whereId($request->id)->first();
        if (!$question) {
            return new DataFailed(
                statusCode: 400,
                message: 'not found'
            );
        }
        return new DataSuccess(
            data: new QuestionBankResource($question),
            statusCode: 200,
            message: 'Fetch Question Bank successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $dataRequest['is_private'] = 0;
            $question = Question::create($dataRequest);
            return new DataSuccess(
                data: new QuestionBankResource($question),
                status: true,
                message: 'Question Bank created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(array $dataRequest): DataStatus
    {
        try {
            $question = Question::whereId($dataRequest['id'])->first();
            if (!$question) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            // $dataRequest['is_private'] = 1;
            unset($dataRequest['id']);
            $question->update($dataRequest);
            return new DataSuccess(
                data: new QuestionBankResource($question),
                status: true,
                message: 'Question Bank updated successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function delete($request): DataStatus
    {
        try {
            $question = Question::whereId($request->id)->first();
            if (!$question) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            $question->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Question Bank deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Question Bank deletion failed: ' . $e->getMessage()
            );
        }
    }
}
