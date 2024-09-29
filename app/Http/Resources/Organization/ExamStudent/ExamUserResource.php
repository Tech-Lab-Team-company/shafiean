<?php

namespace App\Http\Resources\Organization\ExamStudent;


use Illuminate\Http\Resources\Json\JsonResource;

class ExamUserResource extends JsonResource
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
            'id' => $this->id ?? 0,
            'name' => $this->name ?? "",
        ];
    }
}
