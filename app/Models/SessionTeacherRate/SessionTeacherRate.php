<?php

namespace App\Models\SessionTeacherRate;

use App\Models\User;
use App\Models\Teacher;
use App\Models\MainSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionTeacherRate extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'session_teacher_rates';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function session(): BelongsTo
    {
        return $this->belongsTo(MainSession::class, 'session_id');
    }
}
