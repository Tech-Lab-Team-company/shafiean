<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\City;
use App\Models\Country;
use App\Models\BloodType;
use App\Models\MainSession;
use App\Models\DisabilityType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\Organization\Exam\Exam;
use Illuminate\Support\Facades\Schema;
use Illuminate\Notifications\Notifiable;
use App\Observers\OrganizationIdObserver;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Organization\Exam\ExamResult;
use App\Models\Organization\Exam\ExamStudent;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Scopes\PerOrganizationWebsiteScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Organization\Competition\Competition;
use App\Models\SessionStudentRate\SessionStudentRate;
use App\Models\SessionTeacherRate\SessionTeacherRate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Models\Organization\UserRelation\UserRelation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guard = 'web';
    // protected $fillable = [
    //     'name' ,'email', 'phone', 'password', 'gender',
    //     'city_id', 'disability_type_id', 'country_id',
    //     'api_key', 'image'
    // ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    protected $appends  = ["image_link"];

    public function getImageLinkAttribute()
    {
        return $this->image ? url('storage/' . $this->image) : '';
    }
    protected function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = Hash::make($password);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function disability_type()
    {
        return $this->belongsTo(DisabilityType::class);
    }
    public function bloodType(): BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }
    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_results', 'user_id', 'exam_id', 'id')->withTimestamps();
    }
    public function examStundents(): HasMany
    {
        return $this->hasMany(ExamStudent::class, 'user_id', 'id');
    }
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id')->withTimestamps();
    }

    public function subscripe_groups()
    {

        return $this->belongsToMany(Group::class, 'subscriptions', 'user_id', 'group_id')->withTimestamps();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }
    public function examResults(): HasMany
    {
        return $this->hasMany(ExamResult::class, 'user_id', 'id');
    }
    public function sessions()
    {
        return $this->hasMany(UserSession::class, 'user_id', 'id');
    }

    public function parent()
    {
        return $this->belongsToMany(User::class, 'user_relations', 'child_id', 'parent_id')->withTimestamps();
    }

    public function childs()
    {

        return $this->belongsToMany(User::class, 'user_relations', 'parent_id', 'child_id')->withTimestamps();
    }

    public function given_rates()
    {

        return $this->hasMany(SessionStudentRate::class, 'user_id', 'id');
    }

    public function received_rates()
    {
        return $this->hasMany(SessionTeacherRate::class, 'user_id', 'id');
    }

    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_users', 'user_id', 'competition_id')->withTimestamps();
    }
    protected static function booted(): void
    {

        if (Auth::check()) {
            static::addGlobalScope(new PerOrganizationScope);
        } else if (!Route::currentRouteName() === 'user_login') {
            static::addGlobalScope(new PerOrganizationWebsiteScope);
        }
    }
}
