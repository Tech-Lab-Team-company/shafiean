<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationDisabilityType extends Model
{
    use HasFactory;
    protected $table = 'organization_disability_types';
    protected $fillable = [
      'organization_id',
      'disability_type_id',
    ];
    public $timestamps = true;

    public function organization() :BelongsTo
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

    public function disabilityType() :BelongsTo
    {
        return $this->belongsTo('App\Models\DisabilityType', 'disability_type_id');
    }
}
