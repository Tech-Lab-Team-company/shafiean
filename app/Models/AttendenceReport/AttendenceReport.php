<?php

namespace App\Models\AttendenceReport;

use App\Models\Group;
use App\Models\Report\Report;
use App\Models\Stage;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendenceReport extends Model
{
    use HasFactory;
    protected $table = 'attendence_reports';
    protected $fillable = [
        'user_id',
        'report_id',
        'teacher_id',
        'notes',
        'status',
        'is_absent',
        "date",
        'order_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class, 'report_id');
    }
    public function hijriDate(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->date ? Carbon::parse($this->date)->toHijri()->isoFormat('LLLL') : "";
            }
        );
    }
}
