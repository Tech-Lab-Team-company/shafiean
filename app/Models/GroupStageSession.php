<?php

namespace App\Models;

use App\Models\Ayah;
use App\Models\Group;
use App\Models\Stage;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Live\Live;
use App\Models\MainSession;
use App\Models\SessionType;
use App\Models\Surah\Surah;
use App\Models\UserSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    public function session_type()
    {
        return $this->belongsTo(SessionType::class, 'session_type_id');
    }

    public function surah(): BelongsTo
    {
        return $this->belongsTo(Surah::class, 'surah_id');
    }
    public function startAyah(): BelongsTo
    {
        return $this->belongsTo(Ayah::class, 'start_ayah_id');
    }
    public function endAyah(): BelongsTo
    {
        return $this->belongsTo(Ayah::class, 'end_ayah_id');
    }
}
