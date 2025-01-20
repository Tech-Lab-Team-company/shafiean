<?php

namespace App\Services\Organization\Exam;

use Exception;
use App\Models\Group;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Services\Global\FilterService;
use App\Models\Organization\Exam\ExamGroup;
use App\Models\Organization\Exam\ExamResult;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\Exam\GroupExamResource;
use App\Http\Resources\Organization\Exam\GroupExamUserResource;

class GroupExamUserService
{
    public function index($dataRequest)
    {
        try {
            $examResult = ExamResult::whereExamId($dataRequest->exam_id)->paginate(10);
            // $filter_service = new FilterService();
            // if (isset($dataRequest)) {
            //     $filter_service->filterExams($query, $dataRequest);
            // }
            // $exams = $query->orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: GroupExamUserResource::collection($examResult)->response()->getData(true),
                status: true,
                message: 'Group Exam User fetched successfully'
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
}
