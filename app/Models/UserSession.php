<?php

namespace App\Models;

use App\Models\User;
use App\Models\Live\Live;
use App\Models\GroupStageSession;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSession extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = [];

    protected $table = 'user_sessions';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id' ,'id');
    }

    public function session()
    {
        return $this->belongsTo(GroupStageSession::class, 'session_id');
    }

    public function live()
    {
        return $this->belongsTo(Live::class, 'live_id');
    }

    public function group() {

        return $this->belongsTo(Group::class, 'group_id');
    }
}
