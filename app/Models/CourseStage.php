<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseStage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'course_stages';

    public function sessions()
    {
        return $this->belongsToMany(MainSession::class, 'course_stage_sessions', 'course_stage_id', 'session_id')->withTimestamps();
    }
}
