<?php

namespace App\Models;

use App\Models\Live\Live;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupStageSession extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'group_stage_sessions';


    // public function course() {

    //     return $this->belongsTo(Course::class, 'course_id');
    // }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function session()
    {
        return $this->belongsTo(MainSession::class, 'session_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function lives()
    {

        return $this->hasMany(Live::class, 'session_id');
    }

    public function users()
    {
        return $this->hasMany(UserSession::class, 'session_id');
    }
}
