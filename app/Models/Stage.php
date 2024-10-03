<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "stages";

    protected $guarded = [];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id');
    }

    public function organization()
    {

        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function disabilityTypes()
    {

        return $this->belongsToMany(DisabilityType::class, 'stage_disability_types', 'stage_id', 'disability_type_id')->withTimestamps();
    }

    public function quraan()
    {

        return $this->belongsToMany(Quraan::class, 'stage_quraan', 'stage_id', 'quraan_id')->withTimestamps();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_stages', 'stage_id', 'course_id')->withTimestamps();
    }
    public function mainSessions(): HasMany
    {
        return $this->hasMany(MainSession::class, 'stage_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_stages', 'stage_id', 'group_id')->withTimestamps();
    }
}
