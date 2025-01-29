<?php

namespace App\Http\Resources\Organization\MainSession;

use App\Http\Resources\SessionTypeTitleResource;
use Illuminate\Http\Request;
use App\Http\Resources\TeacherNameResource;
use App\Http\Resources\Surah\AyahTitleResource;
use App\Http\Resources\Surah\SurahTitleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchMainSessionDetailsForGroupResource extends JsonResource
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
            'title' => $this->session_id ? $this->session->title : $this->title,
            // 'stage_title' => $this->stage->title ?? "",
            // 'session_type' => $this->session_type->title ?? "",
            'curriculum_title' => $this->stage->curriculum->title ?? "",
            // 'surah_title' => $this->surah->name ?? "",
            // 'start_ayah_title' => $this->startAyah->text ?? "",
            // 'end_ayah_title' => $this->endAyah->text ?? "",
            // 'teacher_name' => $this->teacher->name ?? "",
            'date' => $this->date ?? "",
            'start_time' => $this->start_time ?? "",
            'end_time' => $this->end_time ?? "",
            'is_new' => (bool)$this->with_edit ?? 0,
            'session_type' => new SessionTypeTitleResource($this->session_type) ?? "",
            'teacher' => new TeacherNameResource($this->teacher) ?? "",
            'surah' => new SurahTitleResource($this->surah) ?? "",
            'start_ayah' => new AyahTitleResource($this->startAyah) ?? "",
            'end_ayah' => new AyahTitleResource($this->endAyah) ?? "",
        ];
    }
}
