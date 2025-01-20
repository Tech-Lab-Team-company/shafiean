<?php

namespace App\Http\Resources\Organization\Exam;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamGroupResource;

class GroupExamUserDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'question_title' => $this->question->question ?? "",
            'answer_title' => $this->answer->answer ?? '',
            'is_correct' => $this->is_correct ?? 0,
        ];
    }
}
