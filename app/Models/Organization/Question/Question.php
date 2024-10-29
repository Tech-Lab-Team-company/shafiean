<?php

namespace App\Models\Organization\Question;

use App\Models\Season;
use App\Models\Curriculum;
use App\Models\Organization\Exam\Exam;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Organization\Answer\Answer;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "questions";
    public function curriculum(): BelongsTo
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class, 'season_id');
    }
    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_questions', 'question_id', 'exam_id')->withTimestamps()->withPivot('organization_id');
    }
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'question_id', 'id');
    }
    public function examResultAnswers(): BelongsToMany
    {
        return $this->belongsToMany(Answer::class, "exam_result_answers", "question_id", "answer_id");
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
