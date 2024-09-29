<?php

namespace App\Http\Resources\Organization\QuestionBank;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\QuestionBank\QuestionBankSeasonResource;
use App\Http\Resources\Organization\QuestionBank\QuestionBankCurriculumResource;

class QuestionBankResource extends JsonResource
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
            'curriculum' => new QuestionBankCurriculumResource($this->curriculum ?? "") ?? "",
            'season' => new QuestionBankSeasonResource($this->season ?? "") ?? "",
        ];
    }
}
