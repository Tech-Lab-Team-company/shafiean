<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'course_stages';

    public function sessions()
    {
        return $this->belongsToMany(CourseStageSession::class, 'course_stage_sessions', 'course_stage_id', 'session_id')->withTimestamps();
    }
}
