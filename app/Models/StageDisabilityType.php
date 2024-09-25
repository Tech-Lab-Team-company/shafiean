<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StageDisabilityType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'stage_disability_types';

    protected $guarded = [];
}
