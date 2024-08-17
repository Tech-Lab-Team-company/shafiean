<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'job_title' => $this->job_title,
            'api_key' => $this->api_key,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

