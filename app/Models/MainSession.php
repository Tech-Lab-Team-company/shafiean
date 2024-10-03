<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'main_sessions';

    public function session_type()
    {
        return $this->belongsTo(SessionType::class, 'session_type_id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function quraan()
    {
        return $this->belongsTo(Quraan::class, 'quraan_id');
    }

    public function course_stages()
    {
        return $this->belongsToMany(CourseStage::class, 'course_stage_sessions', 'session_id', 'course_stage_id')->withTimestamps();
    }

    public function courses() {

        return $this->belongsToMany(Course::class, 'course_stage_sessions', 'session_id', 'course_id')->withTimestamps();
    }

    public function groups(){

        return $this->belongsToMany(Group::class, 'group_stage_sessions', 'session_id', 'group_id')->withTimestamps();
    }
}
