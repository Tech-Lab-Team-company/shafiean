<?php

namespace App\Models\Organization\Exam;

use App\Models\User;
use App\Models\Group;
use App\Models\Organization\Question\Question;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = "exams";
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'exam_groups', 'exam_id', 'group_id')->withTimestamps();
    }
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id')->withTimestamps();
    }
    public function bankQuestions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id')->withTimestamps()->where('is_private', 0);;
    }
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'exam_students', 'exam_id', 'user_id')->withTimestamps();
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
