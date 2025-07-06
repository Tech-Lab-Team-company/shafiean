<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //generate unique username
        // $user->username = $user->generateUsername();
        $username = $user->name . '_' . $user->id;
        if (User::where('username', $username)->exists()) {
            $username = $user->name . '_' . $user->id . '_' . time();
        }
        if(!isset($user->password))
        {
            $user->password = $username;
        }
        $user->username = $username;
        $user->save();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
