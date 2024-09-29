<?php

namespace App\Services\Organization\ExamQuestion;

use Exception;
use App\Helpers\Response\DataFailed;
use App\Helpers\Response\DataStatus;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\ExamStudent;
use App\Http\Resources\Organization\ExamStudent\ExamStudentResource;

class ExamStudentService
{
    public function index()
    {
        try {
            $examStudents = ExamStudent::orderBy('id', 'desc')->paginate(10);
            return new DataSuccess(
                data: ExamStudentResource::collection($examStudents)->response()->getData(true),
                status: true,
                message: 'Exam Students fetched successfully'
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
        $examStudent = ExamStudent::whereId($request->id)->first();
        if (!$examStudent) {
            return new DataFailed(
                statusCode: 400,
                message: 'not found'
            );
        }
        return new DataSuccess(
            data: new ExamStudentResource($examStudent),
            statusCode: 200,
            message: 'Fetch Exam Student successfully'
        );
    }
    public function store(array $dataRequest): DataStatus
    {
        try {
            $examStudent = ExamStudent::create($dataRequest);
            return new DataSuccess(
                data: new ExamStudentResource($examStudent),
                status: true,
                message: 'Exam Student created successfully'
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
            $examStudent = ExamStudent::whereId($dataRequest['id'])->first();
            if (!$examStudent) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            unset($dataRequest['id']);
            $examStudent->update($dataRequest);
            return new DataSuccess(
                data: new ExamStudentResource($examStudent),
                status: true,
                message: 'Exam Student updated successfully'
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
            $examStudent = ExamStudent::whereId($request->id)->first();
            if (!$examStudent) {
                return new DataFailed(
                    statusCode: 400,
                    message: 'not found'
                );
            }
            $examStudent->delete();
            return new DataSuccess(
                statusCode: 200,
                message: 'Exam Student deleted successfully'
            );
        } catch (Exception $e) {
            return new DataFailed(
                statusCode: 500,
                message: 'Exam Student deletion failed: ' . $e->getMessage()
            );
        }
    }
}
