<?php

namespace App\Http\Resources\Parent\Child;

use Illuminate\Http\Request;
use App\Models\GroupStageSession;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Parent\Group\ChildGroupResource;
use App\Http\Resources\Parent\Session\ChildSessionAttendanceResource;

class ChildAttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $group_ids = $this->subscripe_groups->pluck('id')->toArray();
        $sessions = GroupStageSession::whereIn('group_id', $group_ids)->get();
        $sessions->each(function ($session) {
            $session->child_id = $this->id;
        });
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sessions' => ChildSessionAttendanceResource::collection($sessions),
        ];
    }
}
