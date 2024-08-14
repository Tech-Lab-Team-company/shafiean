<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stage extends Model
{
    use HasFactory;
    protected $table = "stage";

    protected $fillable = [
        'title',
        'type',
        'order',
        'disability_type_id'
    ];

    /**
     * Get the disability type that owns the stage.
     */
    public function disabilityType() : BelongsTo
    {
        return $this->belongsTo(DisabilityType::class, 'disability_type_id');
    }
}


