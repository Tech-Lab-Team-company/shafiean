<?php

namespace App\Observers;

use App\Models\Teacher;
use Symfony\Component\String\Slugger\AsciiSlugger;
use voku\helper\ASCII;

class TeacherObserver
{
    /**
     * Handle the Teacher "created" event.
     */
    public function created(Teacher $teacher): void
    {
        //generate unique username
        // Transliterate Arabic to Latin and remove unwanted characters
        $originalName = $teacher->name;

        // Transliterate to ASCII
        $transliterated = ASCII::to_ascii($originalName);

        // Slugify
        $baseName = preg_replace('/[^A-Za-z0-9_ ]/', '', $transliterated); // Keep only allowed chars
        $username = str_replace(' ', '_', strtolower($baseName) . '_' . $teacher->id);

        if (Teacher::where('username', $username)->exists()) {
            $username = str_replace(' ', '_', strtolower($baseName) . '_' . $teacher->id . '_' . time());
        }
        if (!isset($teacher->password)) {
            $teacher->password = $username;
        }
        $teacher->username = $username;
        $teacher->save();
    }

    /**
     * Handle the Teacher "updated" event.
     */
    public function updated(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "deleted" event.
     */
    public function deleted(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "restored" event.
     */
    public function restored(Teacher $teacher): void
    {
        //
    }

    /**
     * Handle the Teacher "force deleted" event.
     */
    public function forceDeleted(Teacher $teacher): void
    {
        //
    }
}
