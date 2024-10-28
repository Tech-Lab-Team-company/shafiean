<?php
namespace App\Services\Organization\ExamResult;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Services\Global\FilterService;
use App\Models\Organization\Exam\ExamQuestion;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\Exam\ExamResource;

class ExamResultService
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
