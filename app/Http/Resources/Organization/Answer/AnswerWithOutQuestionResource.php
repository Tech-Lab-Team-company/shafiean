<?php

namespace App\Http\Resources\Organization\Answer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Answer\AnswerQuestionResource;

class AnswerWithOutQuestionResource extends JsonResource
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
            'answer' => $this->answer ?? '',
            'is_correct' => $this->is_correct ?? '',
        ];
    }
}
