<?php

namespace App\Models\Organization\Role;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MapPermission extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'map_permission';
    // public  $timestamps = false;
    public function map(): BelongsTo
    {
        return $this->belongsTo(Map::class);
    }
}
