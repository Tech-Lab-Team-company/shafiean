<?php
namespace App\Http\Resources\User\ExamResult;



use Illuminate\Http\Resources\Json\JsonResource;

class FetchExamResultsTeacherResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
            'image' => $this->image_link ?? "",
        ];
    }
}
