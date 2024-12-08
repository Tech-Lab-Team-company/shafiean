<?php

namespace App\Models;

use App\Models\Scopes\PerOrganizationScope;
use App\Observers\OrganizationIdObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory, SoftDeletes;

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

    public function subscripe_users()
    {

        return $this->belongsToMany(User::class, 'subscriptions', 'group_id', 'user_id')->withTimestamps();
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'group_id');
    }
    public function days()
    {
        return $this->belongsToMany(Day::class, 'group_days', 'group_id', 'day_id')->withPivot('start_time', 'end_time')->withTimestamps();
    }
    public function stages()
    {
        return $this->belongsToMany(Stage::class, 'group_stages', 'group_id', 'stage_id')->withTimestamps();
    }
    public function disabilities()
    {
        return $this->belongsToMany(DisabilityType::class, 'group_disabilities', 'group_id', 'disability_id')->withTimestamps();
    }

    public function sessions()
    {

        return $this->belongsToMany(MainSession::class, 'group_stage_sessions', 'group_id', 'session_id')->withTimestamps();
    }

    public function groupStageSessions()
    {

        return $this->hasMany(GroupStageSession::class, 'group_id');
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
