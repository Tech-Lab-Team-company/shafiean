<?php

namespace App\Http\Resources\Parent\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchChildExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $exams = $this->exams()->get();
        $exams->each(function ($exam) {
            $exam->child_id = $this->id;
        });
        // dd($exams);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'exam_count' => $this->exams()->count(),
            'done_exam_count' => $this->exams()->whereHas('exam_results', function ($q) {
                $q->where('user_id', $this->id);
            })->count(),
            'not_done_exam_count' => $this->exams()->whereDoesntHave('exam_results', function ($q) {
                $q->where('user_id', $this->id);
            })->count(),
            'exams' => ChildExamResource::collection($exams),
        ];
    }
}
