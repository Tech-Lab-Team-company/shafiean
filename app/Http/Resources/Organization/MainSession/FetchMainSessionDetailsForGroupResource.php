<?php

namespace App\Http\Resources\Organization\MainSession;

use Illuminate\Http\Request;
use App\Http\Resources\StageTitleResource;
use App\Http\Resources\TeacherNameResource;
use App\Http\Resources\Surah\AyahTitleResource;
use App\Http\Resources\SessionTypeTitleResource;
use App\Http\Resources\Surah\SurahTitleResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\MainSession\FetchMainSessionTitleResource;

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
            'curriculum_title' => $this->stage->curriculum->title ?? "",
            'date' => $this->date ?? "",
            'start_time' => $this->start_time ?? "",
            'end_time' => $this->end_time ?? "",
            'is_new' => $this->with_edit ?? 0,
            'stage' => new StageTitleResource($this->stage ?? "") ?? "",
            'session' => new FetchMainSessionTitleResource($this->session ?? "") ?? "",
            'session_type' => new SessionTypeTitleResource($this->session_type ?? "") ?? "",
            'teacher' => new TeacherNameResource($this->teacher ?? "") ?? "",
            'surah' => new SurahTitleResource($this->surah ?? "") ?? "",
            'start_ayah' => new AyahTitleResource($this->startAyah ?? "") ?? "",
            'end_ayah' => new AyahTitleResource($this->endAyah ?? "") ?? "",
        ];
    }
}
