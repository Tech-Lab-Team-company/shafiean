<?php

namespace App\Services\User\ExamResultAnswer;



use Exception;
use App\Enum\ExamResultStatusEnum;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Exam\ExamResult;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Models\Organization\Exam\ExamResultAnswer;
use App\Http\Resources\Organization\Exam\ExamResource;
use App\Http\Resources\User\ExamResultAnswer\UserExamResultAnswerResource;
use App\Models\Organization\Answer\Answer;

class ExamResultAnswerService
{
    public function fetchExamResultAnswers($dataRequest)
    {
        try {
            $examResult = ExamResultAnswer::whereExamResultId($dataRequest["exam_result_id"])->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: UserExamResultAnswerResource::collection($examResult)->response()->getData(true),
                status: true,
                message: 'Exam Result Answer fetched successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    public function store(object $dataRequest): DataStatus
    {
        try {
            $userId = auth('user')->user()->id;

            // Fetch active exam result for the user
            $examResult = ExamResult::whereExamId($dataRequest->exam_id)
                ->whereUserId($userId)
                ->whereStatus(ExamResultStatusEnum::ACTIVE->value)
                ->first();

            if (!$examResult) {
                return new DataFailed(
                    status: false,
                    message: __('messages.not_found')
                );
            }

            $answer = Answer::find($dataRequest->answer_id);
            $question = Question::find($dataRequest->question_id);

            if (!$answer || !$question) {
                return new DataFailed(
                    status: false,
                    message: __('messages.error')
                );
            }

            $attributes = [
                'question_id' => $dataRequest->question_id,
                'user_id' => $userId,
                'exam_result_id' => $examResult->id,
            ];
            $examResultAnswer = ExamResultAnswer::where($attributes)->first();

            $questionDegree = $answer->is_correct ? $question->degree : 0;
            // Update exam result and answer if it already exists
            if ($examResultAnswer) {
                // if ($examResultAnswer->answer_id !== $dataRequest->answer_id) {
                //     $this->updateExamResult($examResult, $question, $answer->is_correct, $examResultAnswer->is_correct);
                // }

                $examResultAnswer->update([
                    'answer_id' => $dataRequest->answer_id,
                    'is_correct' => $answer->is_correct,
                    'grade' => $questionDegree, /* ATTENTION */ //if the answer is correct, the grade will be the degree of the question
                ]);



                return new DataSuccess(
                    data: new UserExamResultAnswerResource($examResultAnswer),
                    status: true,
                    message: __('messages.success_update')
                );
            }
            // Create a new answer record if it doesn't exist
            $examResultAnswer = ExamResultAnswer::create([
                ...$attributes,
                'answer_id' => $dataRequest->answer_id,
                'is_correct' => $answer->is_correct,
                'grade' => $questionDegree, /* ATTENTION */ //if the answer is correct, the grade will be the degree of the question
            ]);
            $examResult->update([
                'correct_question_count' => $examResult->correct_question_count + ($answer->is_correct ? 1 : 0),
                'wrong_question_count' => $examResult->wrong_question_count + (!$answer->is_correct ? 1 : 0),
                'grade' => $examResult->grade + $questionDegree,
            ]);
            return new DataSuccess(
                data: new UserExamResultAnswerResource($examResultAnswer),
                status: true,
                message: __('messages.success_create')
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }

    /**
     * Update the exam result counts and grade.
     */
    private function updateExamResult(ExamResult $examResult, Question $question, bool $newCorrect, bool $oldCorrect): void
    {
        $correctDiff = (int) $newCorrect - (int) $oldCorrect;
        $gradeDiff = $correctDiff * $question->degree;
        // dd($correctDiff , $gradeDiff);
        // dd($gradeDiff);

        $examResult->update([
            'correct_question_count' => $examResult->correct_question_count + $correctDiff,
            'wrong_question_count' => $examResult->wrong_question_count - $correctDiff,
            'grade' => $examResult->grade + $gradeDiff,
        ]);
    }
    // public function store(object $dataRequest): DataStatus
    // {
    //     try {
    //         $userId = auth('user')->user()->id;

    //         // Fetch active exam result for the user
    //         $examResult = ExamResult::whereExamId($dataRequest->exam_id)
    //             ->whereUserId($userId)
    //             ->whereStatus(ExamResultStatusEnum::ACTIVE->value)
    //             ->first();

    //         if (!$examResult) {
    //             return new DataFailed(
    //                 status: false,
    //                 message: 'Exam Result not found for user'
    //             );
    //         }

    //         $answer = Answer::find($dataRequest->answer_id);
    //         $question = Question::find($dataRequest->question_id);

    //         if (!$answer || !$question) {
    //             return new DataFailed(
    //                 status: false,
    //                 message: 'Invalid answer or question ID'
    //             );
    //         }

    //         $attributes = [
    //             'question_id' => $dataRequest->question_id,
    //             'user_id' => $userId,
    //             'exam_result_id' => $examResult->id,
    //         ];
    //         $examResultAnswer = ExamResultAnswer::where($attributes)->first();

    //         // Update exam result and answer if it already exists
    //         if ($examResultAnswer) {
    //             if ($examResultAnswer->answer_id !== $dataRequest->answer_id) {
    //                 $this->updateExamResult($examResult, $question, $answer->is_correct, $examResultAnswer->is_correct);
    //             }

    //             $examResultAnswer->update([
    //                 'answer_id' => $dataRequest->answer_id,
    //                 'is_correct' => $answer->is_correct,
    //                 'grade' => $question->degree,
    //             ]);



    //             return new DataSuccess(
    //                 data: new UserExamResultAnswerResource($examResultAnswer),
    //                 status: true,
    //                 message: 'Exam Result Answer updated successfully'
    //             );
    //         }

    //         // Create a new answer record if it doesn't exist
    //         $examResultAnswer = ExamResultAnswer::create([
    //             ...$attributes,
    //             'answer_id' => $dataRequest->answer_id,
    //             'is_correct' => $answer->is_correct,
    //             'grade' => $question->degree,
    //         ]);
    //         $examResult->update([
    //             'correct_question_count' => $examResult->correct_question_count + ($answer->is_correct ? 1 : 0),
    //             'wrong_question_count' => $examResult->wrong_question_count + (!$answer->is_correct ? 1 : 0),
    //             'grade' => $examResult->grade + $question->degree,
    //         ]);
    //         return new DataSuccess(
    //             data: new UserExamResultAnswerResource($examResultAnswer),
    //             status: true,
    //             message: 'Exam Result Answer created successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }

    // /**
    //  * Update the exam result counts and grade.
    //  */
    // private function updateExamResult(ExamResult $examResult, Question $question, bool $newCorrect, bool $oldCorrect): void
    // {
    //     $correctDiff = (int) $newCorrect - (int) $oldCorrect;
    //     $gradeDiff = $correctDiff * $question->degree;
    //     // dd($correctDiff , $gradeDiff);
    //     // dd($gradeDiff);

    //     $examResult->update([
    //         'correct_question_count' => $examResult->correct_question_count + $correctDiff,
    //         'wrong_question_count' => $examResult->wrong_question_count - $correctDiff,
    //         'grade' => $examResult->grade + $gradeDiff,
    //     ]);
    // }
}
