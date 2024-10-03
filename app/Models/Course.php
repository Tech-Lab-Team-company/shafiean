<?php

namespace App\Models;

use App\Models\Scopes\PerOrganizationScope;
use App\Observers\OrganizationIdObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = "courses";


    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id', 'id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id', 'id');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculum_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function disability_types()
    {
        return $this->belongsToMany(DisabilityType::class, 'course_disability_types', 'course_id', 'disability_type_id');
    }

    public function stages()
    {

        return $this->belongsToMany(Stage::class, 'course_stages', 'course_id', 'stage_id')->withTimestamps();
    }
    public function groups()
    {
        $this->hasMany(Group::class, 'course_id');
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
