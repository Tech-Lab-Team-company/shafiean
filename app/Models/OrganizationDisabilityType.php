<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationDisabilityType extends Model
{
    use HasFactory;
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
