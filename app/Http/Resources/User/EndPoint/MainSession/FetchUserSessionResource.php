<?php

namespace App\Http\Resources\User\EndPoint\MainSession;


use Illuminate\Http\Request;
use App\Http\Resources\StageResource;
use App\Http\Resources\QuraanResource;
use App\Http\Resources\Live\LiveInfoResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FetchUserSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isLive = $this->lives()->whereLeaveDate(null)->count() > 0 ? true : false;
        $isSession = $this->session_id ? true : false;
        return [
            'id' => $this->id ?? 0,
            'title' => $isSession ? $this->session->title : $this->title,
            'status' =>  $isSession ? (int) $this->session->status : 0,
            'start_verse' => $isSession ?  $this->session->startAyah : $this->startAyah->text,
            'end_verse' => $isSession ?  $this->session->endAyah : $this->endAyah->text,
            "session_type" => $this->session_type->title ?? "",
            "group_name" => $this->group->title ?? "",
            // "quraan" => new QuraanResource($this->session->quraan) ?? "",
            "stage" =>   $isSession ? new StageResource($this->session->stage) : new StageResource($this->stage),
            'is_live' => $isLive ?? "",
            // 'live' => $isLive ?  LiveInfoResource::collection($this->lives) : []
            'live' => $isLive ?  new LiveInfoResource($this->lives()->latest()->first()) : []
        ];
    }
}
