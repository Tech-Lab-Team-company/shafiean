<?php

namespace App\Services\Organization\Exam;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Services\Global\FilterService;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\Exam\ExamResource;

class ExamService
{
    public function index($dataRequest)
    {
        try {
            $query = Exam::query();
            $filter_service = new FilterService();
            if (isset($dataRequest)) {
                $filter_service->filterExams($query, $dataRequest);
            }
            $exams = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: ExamResource::collection($exams)->response()->getData(true),
                status: true,
                message: 'Exams fetched successfully'
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
        $exam = Exam::whereId($request->id)->first();
        if (!$exam) {
            return new DataFailed(
                statusCode: 400,
                message: 'not found'
            );
        }
        return new DataSuccess(
            data: new ExamResource($exam),
            statusCode: 200,
            message: 'Fetch Exam successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = $this->examData($dataRequest);
            $exam = Exam::create($data);
            if (isset($dataRequest['group_ids']) && count($dataRequest['group_ids']) > 0) {
                $exam->groups()->attach($dataRequest['group_ids']);
            }
            if (isset($dataRequest['bank_question_ids']) && count($dataRequest['bank_question_ids']) > 0) {
                $exam->questions()->attach($dataRequest['bank_question_ids']);
            }
            if (isset($dataRequest['questions']) && count($dataRequest['questions']) > 0) {
                foreach ($dataRequest['questions'] as $questionRequest) {
                    $question = Question::create([
                        'question' => $questionRequest['question'],
                        'type' => $questionRequest['type'],
                        'degree' => $questionRequest['degree'],
                        'is_private' => 1
                    ]);
                    $exam->questions()->attach($question->id);
                    $answers = array_map(function ($answer) {
                        return [
                            'answer' => $answer['answer'],
                            'is_correct' => $answer['is_correct'],
                        ];
                    }, $questionRequest['answers']);

                    $question->answers()->createMany($answers);
                }
            }
            return new DataSuccess(
                data: new ExamResource($exam),
                status: true,
                message: 'Exam created successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
    public function update(object $dataRequest): DataStatus
    {
        try {

            $exam = Exam::whereId($dataRequest['id'])->first();
            if (!$exam) {
                return new DataFailed(
                    statusCode: 404,
                    message: 'not found'
                );
            }
            $hasResult = $exam->exam_results()->count() ? true : false;
            if ($hasResult) {
                return new DataFailed(
                    status: false,
                    statusCode: 400,
                    message: 'الامتحان يحتوى علي نتائج لا يمكن تعديله'
                );
            }

            $data = $this->examData($dataRequest);
            $exam->update($data);
            if (isset($dataRequest['group_ids']) && count($dataRequest['group_ids']) > 0) {
                $exam->groups()->sync($dataRequest['group_ids']);
            }
            if (isset($dataRequest['bank_question_ids']) && count($dataRequest['bank_question_ids']) > 0) {
                $exam->questions()->sync($dataRequest['bank_question_ids']);
            }
            if (isset($dataRequest['questions']) && count($dataRequest['questions']) > 0) {
                $quIds = [];
                foreach ($dataRequest['questions'] as $questionRequest) {
                    $quIds[] = $questionRequest['id'] ?? null;
                    $questionIds = ExamQuestion::where('exam_id', $exam->id)->pluck('question_id')->toArray();
                    foreach ($questionIds as $qId) {
                        if (!in_array($qId, $quIds)) {
                            ExamQuestion::where('question_id', $qId)->where('exam_id', $exam->id)->delete();
                        }
                    }
                    $questionId = $questionRequest['id'] ?? null;
                    $question = Question::updateOrCreate([
                        'id' => $questionId
                    ], [
                        'question' => $questionRequest['question'],
                        'type' => $questionRequest['type'],
                        'degree' => $questionRequest['degree'],
                        'is_private' => 1
                    ]);
                    $exam->questions()->syncWithoutDetaching($question->id);
                    $question->answers()->delete();
                    $answers = array_map(function ($answer) {
                        return [
                            'answer' => $answer['answer'],
                            'is_correct' => $answer['is_correct'],
                        ];
                    }, $questionRequest['answers']);

                    $question->answers()->createMany($answers);
                }
            }
            return new DataSuccess(
                data: new ExamResource($exam),
                status: true,
                message: 'Exam updated successfully'
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
            $exam = Exam::whereId($request->id)->first();
            if (!$exam) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            $exam->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Exam deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Exam deletion failed: ' . $e->getMessage()
            );
        }
    }
    private function examData($dataRequest)
    {
        return  [
            'name' => $dataRequest->name,
            'start_date' => $dataRequest->start_date,
            'end_date' => $dataRequest->end_date,
            'start_time' => $dataRequest->start_time,
            'end_time' => $dataRequest->end_time,
            'duration' => $dataRequest->duration,
            // 'question_count' => $dataRequest->question_count,
            // 'exam_type' => $dataRequest->exam_type,
            // 'degree_type' => $dataRequest->degree_type,
            // 'degree' => $dataRequest->degree,
        ];
    }
}
