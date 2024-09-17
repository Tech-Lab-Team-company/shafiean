<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    protected $token;
    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->token = $token;
    }
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'gender' => $this->gender,
            'age' => $this->age,
            'image' => $this->image_link,
            'is_employed' => $this->is_employed,
            'organization_id' => $this->organization_id,
            'token' => $this->token,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
