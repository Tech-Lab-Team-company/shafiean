<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSession extends Model
{
    use HasFactory;

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
        return $this->belongsToMany(CourseStageSession::class, 'course_stage_sessions', 'session_id', 'course_stage_id')->withTimestamps();
    }
}
