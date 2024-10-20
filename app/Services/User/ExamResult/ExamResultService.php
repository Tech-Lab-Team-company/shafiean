<?php
namespace App\Services\User\ExamResult;



use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Models\Organization\Question\Question;
use App\Http\Resources\Organization\Exam\ExamResource;
use App\Models\Organization\Exam\ExamQuestion;

class ExamResultService
{
    // public function index()
    // {
    //     try {
    //         $exams = Exam::orderBy('id', 'desc')->paginate(10);
    //         return new DataSuccess(
    //             data: ExamResource::collection($exams)->response()->getData(true),
    //             status: true,
    //             message: 'Exams fetched successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }

    // public function store(object $dataRequest): DataStatus
    // {
    //     try {
    //         $exam = Exam::create($data);

    //         return new DataSuccess(
    //             data: new ExamResource($exam),
    //             status: true,
    //             message: 'Exam created successfully'
    //         );
    //     } catch (Exception $e) {
    //         return new DataFailed(
    //             status: false,
    //             message: $e->getMessage()
    //         );
    //     }
    // }

}
