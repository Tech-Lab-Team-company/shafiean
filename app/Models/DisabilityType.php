<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisabilityType extends Model
{
    use HasFactory;
    protected $table = "disability_types";

    protected $fillable = [
        'title',
        'type',
        'order',
        'string'
    ];

    public function users() :HasMany
    {
        return $this->hasMany(User::class , 'disability_type_id');
    }

    public function stages() : HasMany
    {
        return $this->hasMany(Stage::class, 'disability_type_id');
    }
}
