<?php

namespace App\Models\Organization\Exam;

use App\Models\Group;
use App\Models\Organization\Exam\Exam;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamGroup extends Model
{
    use HasFactory, SoftDeletes;
    public $table = 'exam_groups';
    protected $gurded = [];
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class, "exam_id", "id");
    }
    public function group():BelongsTo
    {
        return $this->belongsTo(Group::class, "group_id", "id");
    }
}
