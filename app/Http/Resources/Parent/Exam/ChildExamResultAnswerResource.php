<?php

namespace App\Http\Resources\Parent\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildExamResultAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'question' => $this->question->question,
            'wrong_answer' => $this->answer->answer,
            'correct_answer' => $this->question->answers()->where('is_correct', true)->first()->answer,
        ];
    }
}
