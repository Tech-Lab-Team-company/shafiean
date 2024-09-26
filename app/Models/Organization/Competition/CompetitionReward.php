<?php

namespace App\Models\Organization\Competition;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetitionReward extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'competition_rewards';

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
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
