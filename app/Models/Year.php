<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Year extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'years';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
