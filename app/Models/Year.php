<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\PerOrganizationWebsiteScope;
// use Attribute;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Year extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'years';

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    // protected static function booted(): void
    // {
    //     if (Auth::check()) {
    //         static::addGlobalScope(new PerOrganizationScope);
    //     } else {
    //         static::addGlobalScope(new PerOrganizationWebsiteScope);
    //     }
    //     // static::addGlobalScope(new PerOrganizationScope);
    // }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::observe(OrganizationIdObserver::class);
    // }

    // public function hijriStartDate(): CastsAttribute
    // {
    //     $value = $this->start_date;
    //     return CastsAttribute::make(
    //         get: function ($value) {
    //             return $value ? Carbon::parse($value)->toHijri()->isoFormat('LLLL') : "";
    //         }
    //         // set: fn ($value) => $value ? Carbon::parse($value)->format('Y-m-d') : null,
    //     );
    // }

    // public function hijriEndDate(): CastsAttribute
    // {
    //     $value = $this->end_date;
    //     return CastsAttribute::make(
    //         get: function ($value) {
    //             return $value ? Carbon::parse($value)->toHijri()->isoFormat('LLLL') : "";
    //         }
    //         // set: fn ($value) => $value ? Carbon::parse($value)->format('Y-m-d') : null,
    //     );
    // }

    protected function hijriStartDate(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
            !empty($attributes['start_date'])
            ? Hijri::Date('l d F o', $attributes['start_date'])
            : ""
        );
    }

    protected function hijriEndDate(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) =>
            !empty($attributes['end_date'])
            ? Hijri::Date('l d F o', $attributes['end_date'])
            : ""
        );
    }
}
