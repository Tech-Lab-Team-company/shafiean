<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupStage extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $table = 'group_stages';
    public function groupStageSessions(): HasMany
    {
        return $this->hasMany(GroupStageSession::class, 'group_stage_id');
    }
}
