<?php

namespace App\Services\Organization\ExamQuestion;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\ExamQuestion;
use App\Http\Resources\Organization\Exam\ExamQuestionResource;

class ExamQuestionService
{
    public function index()
    {
        try {
            $examQuestions = ExamQuestion::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: ExamQuestionResource::collection($examQuestions)->response()->getData(true),
                status: true,
                message: 'Exam Questions fetched successfully'
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
        $examQuestion = ExamQuestion::whereId($request->id)->first();
        if (!$examQuestion) {
            return new DataFailed(
                statusCode: 400,
                message: 'not found'
            );
        }
        return new DataSuccess(
            data: new ExamQuestionResource($examQuestion),
            statusCode: 200,
            message: 'Fetch Exam Question successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $examQuestion = ExamQuestion::create($dataRequest);
            return new DataSuccess(
                data: new ExamQuestionResource($examQuestion),
                status: true,
                message: 'Exam Question created successfully'
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
            $examQuestion = ExamQuestion::whereId($dataRequest['id'])->first();
            if (!$examQuestion) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            unset($dataRequest['id']);
            $examQuestion->update($dataRequest);
            return new DataSuccess(
                data: new ExamQuestionResource($examQuestion),
                status: true,
                message: 'Exam Question updated successfully'
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
            $examQuestion = ExamQuestion::whereId($request->id)->first();
            if (!$examQuestion) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            $examQuestion->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Exam Question deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Exam Question deletion failed: ' . $e->getMessage()
            );
        }
    }
}
