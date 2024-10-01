<?php

namespace App\Services\Organization\Exam;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\Exam\ExamResource;

class ExamService
{
    public function index()
    {
        try {
            $exams = Exam::orderBy('id', 'desc')->paginate(10);
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
            $data['name'] = $dataRequest->name;
            $data['start_date'] = $dataRequest->start_date;
            $data['end_date'] = $dataRequest->end_date;
            $data['start_time'] = $dataRequest->start_time;
            $data['end_time'] = $dataRequest->end_time;
            $data['duration'] = $dataRequest->duration;
            $data['question_count'] = $dataRequest->question_count;
            $data['exam_type'] = $dataRequest->exam_type;
            $data['degree_type'] = $dataRequest->degree_type;
            $data['degree'] = $dataRequest->degree;
            $exam = Exam::create($data);
            if (isset($dataRequest['group_ids']) && count($dataRequest['group_ids']) > 0) {
                $exam->groups()->attach($dataRequest['group_ids']);
            }
            if (isset($dataRequest['question_ids']) && count($dataRequest['question_ids']) > 0) {
                $exam->questions()->attach($dataRequest['question_ids']);
            }
            if (isset($dataRequest['question']) && count($dataRequest['question']) > 0) {
                $question = Question::create([
                    'question' => $dataRequest['question']['question'],
                    'type' => $dataRequest['question']['type'],
                    'degree' => $dataRequest['question']['degree'],
                    'is_private' => 1
                ]);
                $exam->questions()->attach($question->id);
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
                    statusCode: 400,
                    message: 'not found'
                );
            }
            unset($dataRequest['id']);
            $data['name'] = $dataRequest->name;
            $data['start_date'] = $dataRequest->start_date;
            $data['end_date'] = $dataRequest->end_date;
            $data['start_time'] = $dataRequest->start_time;
            $data['end_time'] = $dataRequest->end_time;
            $data['duration'] = $dataRequest->duration;
            $data['question_count'] = $dataRequest->question_count;
            $data['exam_type'] = $dataRequest->exam_type;
            $data['degree_type'] = $dataRequest->degree_type;
            $data['degree'] = $dataRequest->degree;
            $exam->update($data);
            if (isset($dataRequest['group_ids']) && count($dataRequest['group_ids']) > 0) {
                $exam->groups()->sync($dataRequest['group_ids']);
            }
            if (isset($dataRequest['question_ids']) && count($dataRequest['question_ids']) > 0) {
                $exam->questions()->sync($dataRequest['question_ids']);
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
}
