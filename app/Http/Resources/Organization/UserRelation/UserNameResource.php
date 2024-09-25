<?php
namespace App\Http\Resources\Organization\UserRelation;


use Illuminate\Http\Resources\Json\JsonResource;

class UserNameResource extends JsonResource
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
