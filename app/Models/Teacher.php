<?php

namespace App\Models;

use App\Models\Curriculum;
use App\Models\Organization;
use App\Models\GroupStageSession;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Organization\JobType\JobType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SessionStudentRate\SessionStudentRate;
use App\Models\SessionTeacherRate\SessionTeacherRate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;
    protected $table = 'teachers';
    // protected $guard = 'organization';
    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
    protected function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }

    public function curriculums()
    {
        return $this->belongsToMany(Curriculum::class, 'teacher_curriculums', 'teacher_id', 'curriculum_id')->withTimestamps();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function jobType(): BelongsTo
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function subscriptions()
    {
        return $this->MorphMany(Subscription::class, 'creatable');
    }

    public function given_rates()
    {

        return $this->hasMany(SessionTeacherRate::class, 'teacher_id', 'id');
    }

    public function received_rates()
    {
        return $this->hasMany(SessionStudentRate::class, 'teacher_id', 'id');
    }
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id')->withTimestamps();
    }
    public function sessions(): HasMany
    {
        return $this->hasMany(GroupStageSession::class, 'teacher_id', 'id');
    }
    public function teacherGroups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_stage_sessions', 'teacher_id', 'group_id');
    }
    public function teacherRates(): HasMany
    {
        return $this->hasMany(SessionTeacherRate::class, 'teacher_id');
    }
}
