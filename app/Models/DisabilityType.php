<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisabilityType extends Model
{
    use HasFactory;
    protected $table = "disability_types";

    protected $guarded = [];

    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }

    // public function users(): HasMany
    // {
    //     return $this->hasMany(User::class, 'disability_type_id');
    // }

    // public function organizationDisabilityTypes(): HasMany
    // {
    //     return $this->hasMany('App\Models\OrganizationDisabilityType', 'disability_type_id');
    // }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_disability_types', 'disability_type_id', 'organization_id')->withTimestamps();
    }
}
