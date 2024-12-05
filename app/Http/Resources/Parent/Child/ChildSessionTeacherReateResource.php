<?php

namespace App\Http\Resources\Parent\Child;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildSessionTeacherReateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $last_rate = $this->received_rates()->latest()->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_rate_date' => $last_rate?->created_at->format('Y-m-d') ?? '',
            'total_degree' => $this->examResults()->sum('grade'),
        ];
    }
}
