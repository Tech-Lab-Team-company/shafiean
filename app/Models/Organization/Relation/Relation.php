<?php

namespace App\Models\Organization\Relation;

use App\Models\Scopes\PerOrganizationScope;
use App\Observers\OrganizationIdObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "relations";
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
