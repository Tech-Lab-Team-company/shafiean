<?php

namespace App\Observers;

use App\Models\User;
use voku\helper\ASCII;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //generate unique username
        // Transliterate Arabic to Latin and remove unwanted characters
        $originalName = $user->name;

        // Transliterate to ASCII
        $transliterated = ASCII::to_ascii($originalName);

        // Slugify
        $baseName = preg_replace('/[^A-Za-z0-9_ ]/', '', $transliterated); // Keep only allowed chars
        $username = str_replace(' ', '_', strtolower($baseName) . '_' . $user->id);

        if (User::where('username', $username)->exists()) {
            $username = str_replace(' ', '_', strtolower($baseName) . '_' . $user->id . '_' . time());
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
