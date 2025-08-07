<?php

namespace App\Modules\Notification\Infrastructure\Persistence\Models\Topic;

use App\Modules\Auth\Infrastructure\Persistence\Models\Customer\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    protected $fillable = [
        'name',
        'type',
        'max',
        'count',
        'order'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'topic_user', 'topic_id', 'user_id')
            // ->withPivot('is_subscribed', 'is_active')
            ->withTimestamps();
    }
}
