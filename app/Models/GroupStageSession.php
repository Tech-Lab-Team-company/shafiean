<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupStageSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'group_stage_sessions';
}
