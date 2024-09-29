<?php

namespace App\Models\Organization\Exam;

use App\Models\User;
use App\Models\Organization\Exam\Exam;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamStudent extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "exam_students";
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }
    protected static function booted(): void
    {
        static::addGlobalScope(new PerOrganizationScope);
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
