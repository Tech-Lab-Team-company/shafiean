<?php

namespace App\Models\Organization\UserRelation;

use App\Models\User;
use App\Enum\UserTypeEnum;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization\Relation\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRelation extends Model
{

    use HasFactory, SoftDeletes;
    protected $table = 'user_relations';
    protected $guarded = [];
    public function relation(): BelongsTo
    {
        return $this->belongsTo(Relation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id', 'id')->whereType(UserTypeEnum::PARENT->value);
    }
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'child_id', 'id')->whereType(UserTypeEnum::STUDENT->value);
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
