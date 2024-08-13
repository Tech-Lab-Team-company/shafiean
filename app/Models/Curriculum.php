<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $fillable = ['title', 'type', 'time', 'from', 'to', 'order'];
}

