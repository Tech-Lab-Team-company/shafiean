<?php

namespace App\Http\Resources\Organization\Exam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Exam\ExamGroupResource;

class GroupExamUserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'user_name' => $this->user->name ?? '',
            'degree' => $this->grade ?? '',
            'created_at' => $this->created_at ?? '',
        ];
    }
}
