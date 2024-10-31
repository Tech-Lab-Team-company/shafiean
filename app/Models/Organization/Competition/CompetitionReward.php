<?php

namespace App\Models\Organization\Competition;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompetitionReward extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $table = 'competition_rewards';

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
