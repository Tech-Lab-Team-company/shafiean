<?php

namespace App\Http\Resources\Organization\CompetitionReward;

use Illuminate\Http\Request;
use App\Http\Resources\SimpleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\Competition\CompetitionResource;

class CompetitionRewardUserResource extends JsonResource
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
            'stage' => (int) $this->stage ?? "",
            'reward' => (int) $this->reward ?? "",
            'user' => new SimpleUserResource($this->user) ?? "",
        ];
    }
}
