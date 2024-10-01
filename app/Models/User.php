<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\BloodType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\Organization\Exam\Exam;
use Illuminate\Notifications\Notifiable;
use App\Models\Organization\Exam\ExamStudent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
    protected $guard = 'web';
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
        return $this->belongsToMany(Exam::class, 'exam_students', 'user_id', 'exam_id', 'id')->withTimestamps();
    }
    public function examStundents(): HasMany
    {
        return $this->hasMany(ExamStudent::class, 'user_id', 'id');
    }
    public function groups(): BelongsToMany{
        return $this->belongsToMany(Group::class, 'user_groups', 'user_id', 'group_id')->withTimestamps();
    }
}
