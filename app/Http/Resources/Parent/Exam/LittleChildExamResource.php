<?php

namespace App\Http\Resources\Parent\Exam;

use App\Models\Organization\Exam\ExamGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LittleChildExamResource extends JsonResource
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
            'name' => $this->name ?? "",
            'date' => $this->start_date ?? "",
            'degree' => $this->degree ?? 0,
        ];
    }
}
