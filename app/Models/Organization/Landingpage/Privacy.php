<?php

namespace App\Models\Organization\Landingpage;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Privacy extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    protected static function booted(): void
    {
        if (Auth::check()) {
            static::addGlobalScope(new PerOrganizationScope);
        } else {
            static::addGlobalScope(new PerOrganizationWebsiteScope);
        }
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(OrganizationIdObserver::class);
    }
}
