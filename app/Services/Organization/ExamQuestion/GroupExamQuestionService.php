<?php

namespace App\Services\Organization\ExamQuestion;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\Exam\ExamQuestionResource;
use App\Http\Resources\Organization\GroupExamQuestion\GroupExamQuestionResource;
use App\Models\Organization\Answer\Answer;

class GroupExamQuestionService
{
    public function index($dataRequest)
    {
        try {
            $questions = Exam::whereId($dataRequest['id'])->first()->questions()->orderBy('id', 'desc')
                ->paginate(10);
            return new DataSuccess(
                data: GroupExamQuestionResource::collection($questions)->response()->getData(true),
                status: true,
                message: 'تم جلب البيانات بنجاح'
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
        $question = Question::whereId($request->id)->first();
        if (!$question) {
            return new DataFailed(
                statusCode: 400,
                message: 'غير موجود'
            );
        }
        return new DataSuccess(
            data: new GroupExamQuestionResource($question),
            statusCode: 200,
            message: 'تم جلب البيانات بنجاح'
        );
    }
    public function update($dataRequest): DataStatus
    {
        try {
            $question = Question::whereId($dataRequest->question_id)->first();
            if (!$question) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            $hasAnswer = $question->examResultAnswers()->count() ? true : false;
            if ($hasAnswer) {
                return new DataSuccess(
                    status: false,
                    statusCode: 400,
                    message: 'السؤال يحتوى علي اجابات لا يمكن تعديله'
                );
            }
            $question->update([
                'question' => $dataRequest->question,
                'type' => $dataRequest->type,
                'degree' => $dataRequest->degree,
            ]);
            $question->answers()->forcedelete();
            $this->storeAnswer($question, $dataRequest);
            return new DataSuccess(
                data: new GroupExamQuestionResource($question),
                status: true,
                message: 'تم تعديل السؤال بنجاح'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function store($dataRequest): DataStatus
    {
        try {
            $exam = Exam::whereId($dataRequest['exam_id'])->first();
            $question = $this->storeQuestion($exam, $dataRequest);
            return new DataSuccess(
                data: new GroupExamQuestionResource($question),
                status: true,
                message: 'تم اضافة السؤال بنجاح'
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
                    message: 'غير موجود'
                );
            }
            $question->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'تم حذف السؤال بنجاح'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Exam Question deletion failed: ' . $e->getMessage()
            );
        }
    }
    private function storeQuestion($exam, $dataRequest)
    {
        $question =  Question::create([
            'question' => $dataRequest['question'],
            'type' => $dataRequest['type'],
            'degree' => $dataRequest['degree'],
            'is_private' => 1
        ]);
        $this->updateExamDegree($exam, $dataRequest['degree']);
        $this->assignExamQuestion($exam, $question);
        $this->storeAnswer($question, $dataRequest);
        return $question;
    }
    private function assignExamQuestion($exam, $question)
    {
        return   $exam->questions()->attach($question->id);
    }
    private function storeAnswer($question, $dataRequest)
    {
        $answers = array_map(function ($answer) {
            return [
                'answer' => $answer['answer'],
                'is_correct' => $answer['is_correct'],
            ];
        }, $dataRequest['answers']);
        $this->assignAnswerQuestion($question, $answers);
    }
    private function assignAnswerQuestion($question, $answers)
    {
        return $question->answers()->createMany($answers);
    }
    private function updateExamDegree($exam, $degree)
    {
        $exam->update([
            'degree' => $exam->degree + $degree
        ]);
    }
}
