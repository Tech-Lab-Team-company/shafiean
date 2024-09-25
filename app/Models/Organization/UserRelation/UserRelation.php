<?php

namespace App\Models\Organization\UserRelation;

use App\Enum\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Organization\Relation\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRelation extends Model
{

    use HasFactory;
    protected $table = 'user_relations';
    protected $guarded = [];
    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class)->whereType(UserTypeEnum::STUDENT->value);
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
