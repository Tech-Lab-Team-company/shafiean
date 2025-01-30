<?php

namespace App\Http\Resources\Teacher\StudentReports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherStudentExamWrongAnswerResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'question_title' => $this->question->question ?? '',
            'wrong_answer_title' => $this->answer->answer ?? '',
            'correct_answer_title' => $this->question->answers()->where('is_correct', true)?->first()?->answer ?? '',
        ];
    }
}
