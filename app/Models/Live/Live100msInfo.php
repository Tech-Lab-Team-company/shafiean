<?php

namespace App\Models\Live;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Live100msInfo extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];


    public function live()
    {
        return $this->belongsTo(Live::class, 'live_id');
    }
}
