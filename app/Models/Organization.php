<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "organizations";

    protected $guarded = [];

    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }

    public function disability_types()
    {
        return $this->belongsToMany(DisabilityType::class, 'organization_disability_types', 'organization_id', 'disability_type_id')->withTimestamps();
    }
}
