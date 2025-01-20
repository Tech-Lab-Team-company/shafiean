<?php

namespace App\Http\Controllers\Organization\Exam;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\Response\DataFailed;
use App\Http\Controllers\Controller;
use App\Helpers\Response\DataSuccess;
use App\Models\Organization\Exam\Exam;
use App\Http\Requests\Organization\Exam\Exam\FetchExamDetailsRequest;

class ChangeExamStatusController extends Controller
{
    public function toggleStatus(FetchExamDetailsRequest $request)
    {
        try {
            $exam = Exam::whereId($request->id)->first();
            $exam->update([
                'status' => $exam->status == 1 ? 0 : 1
            ]);
            return (new DataSuccess(
                status: true,
                message: 'تم تغير الحاله'
            ))->response();
        } catch (Exception $e) {
            return new DataFailed(
                status: false,
                message: $e->getMessage()
            );
        }
    }
}
