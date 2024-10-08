<?php

namespace App\Http\Resources\Organization\Question;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Answer\AnswerResource;
use App\Http\Resources\Organization\Question\QuestionAnswerResource;
use App\Http\Resources\Organization\Question\QuestionSeasonResource;
use App\Http\Resources\Organization\Question\QuestionCurriculumResource;

class QuestionResource extends JsonResource
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
            'question' => $this->question ?? "",
            'type' => $this->type ?? "",
            'degree' => (int) $this->degree ?? "",
            'is_private' => (int)$this->is_private ?? "",
            "answers" =>  QuestionAnswerResource::collection($this->answers ?? []) ?? [],
        ];
    }
}
