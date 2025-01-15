<?php

namespace App\Http\Resources\Organization\Exam;

use App\Http\Resources\Organization\Question\QuestionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id ?? 0,
            'exam' => new ExamResource($this->exam ?? "") ?? "",
            // 'question' => new QuestionResource($this->question ?? "") ?? "",
        ];
    }
}
