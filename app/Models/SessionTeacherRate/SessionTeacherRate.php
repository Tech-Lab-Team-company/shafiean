<?php

namespace App\Models\SessionTeacherRate;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
