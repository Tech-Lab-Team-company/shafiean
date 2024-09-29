<?php

namespace App\Http\Resources\Organization\ExamStudent;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamResource;
use App\Http\Resources\Organization\ExamStudent\ExamUserResource;

class ExamStudentResource extends JsonResource
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
            'user' => new ExamUserResource($this->user ?? "") ?? "",
            'grade' => $this->grade ?? "",
            'is_pass' => $this->is_pass ?? 0
        ];
    }
}
