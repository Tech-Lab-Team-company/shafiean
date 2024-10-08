<?php

namespace App\Services\Organization\Question;


use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Answer\Answer;
use App\Models\Organization\Question\Question;
use App\Models\Organization\Relation\Relation;
use App\Http\Resources\Organization\Question\QuestionResource;
use App\Http\Resources\Organization\Relation\RelationResource;

class QuestionService
{
    public function index()
    {
        try {
            $questions = Question::where('is_private', 1)->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: QuestionResource::collection($questions)->response()->getData(true),
                status: true,
                message: 'Questions fetched successfully'
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
        $question = Question::where('is_private', 1)->whereId($request->id)->first();
        if (!$question) {
            return new DataFailed(
                statusCode: 400,
                message: 'not found'
            );
        }
        return new DataSuccess(
            data: new QuestionResource($question),
            statusCode: 200,
            message: 'Fetch Question successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            foreach ($dataRequest['questions'] as  $questionRequest) {
                $data = [
                    'question' => $questionRequest['title'],
                    'type' => $questionRequest['type'],
                    'degree' => $questionRequest['degree'],
                    'is_private' => 1
                ];
                $question = Question::create($data);
                if (isset($questionRequest['answers'])) {
                    $answers = array_map(function ($answer) {
                        return [
                            'answer' => $answer['title'],
                            'is_correct' => $answer['is_correct'],
                        ];
                    }, $questionRequest['answers']);
                    $question->answers()->createMany($answers);
                }
            }

            return new DataSuccess(
                data: new QuestionResource($question),
                status: true,
                message: 'Question created successfully'
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
            unset($dataRequest['id']);
            $data = [
                'question' => $dataRequest['title'],
                'type' => $dataRequest['type'],
                'degree' => $dataRequest['degree'],
            ];
            $question->update($data);
            if (isset($dataRequest['answers'])) {
                $question->answers()->delete();
                $answers = array_map(function ($answer) {
                    return [
                        'answer' => $answer['title'],
                        'is_correct' => $answer['is_correct'],
                    ];
                }, $dataRequest['answers']);
                $question->answers()->createMany($answers);
            }
            return new DataSuccess(
                data: new QuestionResource($question),
                status: true,
                message: 'Question updated successfully'
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
                message: 'Question deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Question deletion failed: ' . $e->getMessage()
            );
        }
    }
}
