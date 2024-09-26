<?php

namespace App\Models\Organization\JobType;

use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobType extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $table = 'job_types';
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
