<?php

namespace App\Http\Resources\Organization\ExamStudent\EndPoint;


use Illuminate\Http\Request;
use App\Http\Resources\GroupResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamResource;
use App\Http\Resources\Organization\ExamStudent\ExamUserResource;

class FetchExamStudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->user->id ?? 0,
            'name' => $this->user->name ?? "",
            'grade' => $this->grade ?? "",
            'is_pass' => $this->is_pass ?? 0,
            'groups'=>GroupResource::collection($this->user->groups ?? [])
        ];
    }
}
