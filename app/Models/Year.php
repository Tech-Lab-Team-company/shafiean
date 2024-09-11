<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'years';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
