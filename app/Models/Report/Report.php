<?php

namespace App\Models\Report;

use App\Models\Group;
use App\Models\Stage;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $fillable = [
        'user_id',
        'degree',
        'notes',
        'from_reportable_id',
        'from_reportable_type',
        'from_sub_reportable_id',
        'from_sub_reportable_type',
        'to_reportable_id',
        'to_reportable_type',
        'to_sub_reportable_id',
        'to_sub_reportable_type',
        'status',
        'type',
        'is_absent',
        'group_id',
        'stage_id',
        'session_id',
        'teacher_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function stage(): BelongsTo
    {
        return $this->belongsTo(Stage::class, 'stage_id');
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

}
