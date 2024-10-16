<?php

namespace App\Http\Resources\Organization\Subscription;

use Illuminate\Http\Request;
use App\Http\Resources\GroupResource;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Organization\UserRelation\UserNameResource;
use App\Http\Resources\Organization\Subscription\SubscriptionUserResource;
use App\Http\Resources\Organization\Subscription\SubscriptionGroupResource;
use App\Http\Resources\Organization\Subscription\SubscriptionCourseResource;

class SubscriptionResource extends JsonResource
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
            'user' => new SubscriptionUserResource($this->user ?? "") ?? "",
            'course' => new SubscriptionCourseResource($this->course) ?? "",
            "group" => new SubscriptionGroupResource($this->group)
        ];
    }
}
