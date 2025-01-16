<?php

namespace App\Http\Resources\Organization\MainSession;


use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\QuraanResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchMainSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isSession = $this->session_id ? true : false;
        return [
            'id' => $this->id ?? 0,
            'title' => $isSession ? $this->session->title : $this->title,
            'start_verse' => $isSession ? (int) $this->session->start_verse : $this->start_verse,
            'end_verse' => $isSession ? (int) $this->session->end_verse : $this->end_verse,
            "teacher_name" => $this->teacher->name ?? "",
            "stage" => new StageResource($this->stage) ?? "",
        ];
    }
}
