<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationDisabilityType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'organization_disability_types';
    protected $fillable = [
      'organization_id',
      'disability_type_id',
    ];
    public $timestamps = true;

    public function organization() :HasMany
    {
        return $this->hasMany('DisabilityType', 'organization_id');
    }
}
