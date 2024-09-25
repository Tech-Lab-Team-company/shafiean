<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\AdminHistoryFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'admin_histories';

    protected $fillable = [
        'admin_id',
        'creatable_type',
        'editable_type',
        'model_id',
        'type',
        'order',
    ];

    protected static function newFactory()
    {
        return AdminHistoryFactory::new();
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
