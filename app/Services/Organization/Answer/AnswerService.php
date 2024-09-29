<?php

namespace App\Services\Organization\Answer;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Answer\Answer;
use App\Models\Organization\Question\Question;
use App\Models\Organization\Relation\Relation;
use App\Http\Resources\Organization\Answer\AnswerResource;
use App\Http\Resources\Organization\Question\QuestionResource;
use App\Http\Resources\Organization\Relation\RelationResource;

class AnswerService
{
    public function index()
    {
        try {
            $answers = Answer::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: AnswerResource::collection($answers)->response()->getData(true),
                status: true,
                message: 'Answers fetched successfully'
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
        $answer = Answer::whereId($request->id)->first();
        if (!$answer) {
            return new DataFailed(
                statusCode: 400,
                message: 'not found'
            );
        }
        return new DataSuccess(
            data: new AnswerResource($answer),
            statusCode: 200,
            message: 'Fetch Answer successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $answer = Answer::create($dataRequest);
            return new DataSuccess(
                data: new AnswerResource($answer),
                status: true,
                message: 'Answer created successfully'
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
            $answer = Answer::whereId($dataRequest['id'])->first();
            if (!$answer) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            unset($dataRequest['id']);
            $answer->update($dataRequest);
            return new DataSuccess(
                data: new AnswerResource($answer),
                status: true,
                message: 'Answer updated successfully'
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
            $answer = Answer::whereId($request->id)->first();
            if (!$answer) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            $answer->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Answer deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Answer deletion failed: ' . $e->getMessage()
            );
        }
    }
}
