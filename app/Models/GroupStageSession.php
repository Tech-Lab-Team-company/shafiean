<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupStageSession extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'group_stage_sessions';
}
