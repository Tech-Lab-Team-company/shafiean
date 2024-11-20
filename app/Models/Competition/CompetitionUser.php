<?php

namespace App\Models\Competition;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionUser extends Model
{
    use HasFactory;

    protected $guarded = [] ;
    protected $table = 'competition_users';
}
