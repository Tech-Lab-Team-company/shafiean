<?php

namespace App\Models;

use App\Models\Stage;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "curriculums";

    protected $guarded = [];
    public function stages():HasMany{
        return $this->hasMany(Stage::class,'curriculum_id','id');
    }

    public function curriculumType()
    {
        return $this->belongsTo(CurriculumType::class, 'curriculum_type_id', 'id');
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

