<?php

namespace App\Http\Resources\User\ExamResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\ExamResult\UserExamResource;

class FetchExamResultResource extends JsonResource
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
            'grade' => (int)$this->grade ?? 0,
            'status' => (int) $this->status ?? 0,
            'exam' => new UserExamResource($this->exam ?? "") ?? "",
        ];
    }
}
