<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'groups';


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function days()
    {
        return $this->belongsToMany(Day::class, 'group_days', 'group_id', 'day_id')->withPivot('start_time', 'end_time' )->withTimestamps();
    }
}
