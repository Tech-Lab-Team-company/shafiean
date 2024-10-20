<?php

namespace App\Models\Organization\Exam;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization\Exam\Exam;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamResult extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "exam_results";
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class, "exam_id", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
    protected static function booted(): void
    {
        if (Auth::check()) {
            static::addGlobalScope(new PerOrganizationScope);
        } else {
            static::addGlobalScope(new PerOrganizationWebsiteScope);
        }
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
