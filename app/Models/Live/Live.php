<?php

namespace App\Models\Live;

use App\Models\Group;
use App\Models\Course;
use App\Models\Organization;
use App\Models\GroupStageSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Live extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function session()
    {
        return $this->belongsTo(GroupStageSession::class, 'session_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function live_info()
    {

        return $this->hasOne(Live100msInfo::class, 'live_id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    protected static function booted(): void
    {
        if (Auth::check()) {
            static::addGlobalScope(new PerOrganizationScope);
        } else {
            static::addGlobalScope(new PerOrganizationWebsiteScope);
        }
        // static::addGlobalScope(new PerOrganizationScope);
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
