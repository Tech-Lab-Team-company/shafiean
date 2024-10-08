<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Season extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'seasons';

    public function Country()
    {

        return $this->belongsTo(Country::class, 'country_id', 'id');
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
