<?php

namespace App\Http\Resources\Teacher\Group;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamQuestionAndAnswerResource;
use App\Models\Group;
use App\Models\Organization\Exam\ExamGroup;

class TeacherGroupExamDetailsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $groupId = ExamGroup::where('exam_id', $this->id)->first()->group_id;
        $groupName = Group::where('id', $groupId)->first()->title;
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
            'start_date' => $this->start_date ?? '',
            'end_date' => $this->end_date ?? '',
            'start_time' => $this->start_time ?? '',
            'end_time' => $this->end_time ?? '',
            'duration' => $this->duration ?? '',
            'status' => $this->status ?? 0,
            'exam_type' => $this->exam_type ?? 0,
            'degree_type' => $this->degree_type ?? 0,
            'group_name' => $groupName ?? "",
            "questions" => ExamQuestionAndAnswerResource::collection($this->questions ?? []) ?? "",
        ];
    }
}
