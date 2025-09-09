<?php

namespace App\Models\Chat;

use App\Models\User;
use App\Models\Message\Message;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'type',
    ];

    protected $table = 'chats';

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_users', 'chat_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
