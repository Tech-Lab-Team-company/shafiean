<?php

namespace App\Http\Resources\Teacher\Group;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherGroupLastSessionResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $isSession = $this->session_id ? true : false;
        return [
            'id' => $this->id ?? 0,
            'title' => $isSession ? $this->session->title : $this->title,
            "date" => $this->date ?? "",
        ];
    }
}
