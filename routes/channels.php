<?php

use App\Models\Chat\Chat;
use App\Enum\ChatTypeEnum;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('private-channel.{id}', function ($user, $id) {
    Log::info([
        'user_id' => $user->id,
        'id' => $id
    ]);
    return Chat::whereHas('users', function ($query) use ($user, $id) {
        $query->whereIn('user_id', [$user->id, $id]);
    })->where('type', ChatTypeEnum::PRIVATE->value)->exists();
});
