<?php

namespace App\Http\Resources\Organization\Competition;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\CompetitionReward\CompetitionRewardResource;

class CompetitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if (auth()->guard('user')->check()) {

            $is_joined = $this->users()->where('user_id', auth()->guard('user')->user()->id)->exists();
        }
        $response = [
            'id' => $this->id ?? 0,
            'name' => $this->name ?? '',
            'description' => $this->description ?? '',
            'start_date' => $this->start_date ?? '',
            'end_date' => $this->end_date ?? '',
            'image' => $this->image_link ?? '',
            'rewards' => CompetitionRewardResource::collection($this->competitionRewards) ?? [],
        ];

        if (auth()->guard('user')->check()) {
            $isJoined = $this->users()->where('user_id', auth()->guard('user')->user()->id)->exists();
            $response['is_joined'] = $isJoined;
        }

        return $response;
    }
}
