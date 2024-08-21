<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $tokenName = $this->resource->first_name . ' ' . $this->resource->last_name ?: 'default_token_name';

        $token = $this->resource->createToken($tokenName)->plainTextToken;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'api_key' => $this->api_key,
            'image' => $this->image,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
            'token' => $token
        ];
    }
}

