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
use App\Http\Resources\Organization\Exam\GroupExamResource;

class GroupExamService
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
                data: GroupExamResource::collection($exams)->response()->getData(true),
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
            data: new GroupExamResource($exam),
            statusCode: 200,
            message: 'Fetch Exam successfully'
        );
    }
    public function store(object $dataRequest): DataStatus
    {
        try {
            $data = $this->examData($dataRequest);
            $exam = Exam::create($data);
            return new DataSuccess(
                data: new GroupExamResource($exam),
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
            $data = $this->examData($dataRequest);
            $exam->update($data);
            return new DataSuccess(
                data: new GroupExamResource($exam),
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
            'group_id' => $dataRequest->group_id,
            // 'question_count' => $dataRequest->question_count,
            // 'exam_type' => $dataRequest->exam_type,
            // 'degree_type' => $dataRequest->degree_type,
            // 'degree' => $dataRequest->degree,
        ];
    }
}
