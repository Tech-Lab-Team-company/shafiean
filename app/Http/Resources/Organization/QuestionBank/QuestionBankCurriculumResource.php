<?php

namespace App\Http\Resources\Organization\QuestionBank;



use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionBankCurriculumResource extends JsonResource
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
            'title' => $this->title ?? "",
            'type' => $this->type ?? "",
            'status' => $this->status ?? "",
        ];
    }
}
