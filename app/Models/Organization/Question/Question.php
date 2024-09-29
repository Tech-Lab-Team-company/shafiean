<?php

namespace App\Models\Organization\Question;

use App\Models\Season;
use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
