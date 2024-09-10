<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'seasons';

    public function Country()
    {

        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
