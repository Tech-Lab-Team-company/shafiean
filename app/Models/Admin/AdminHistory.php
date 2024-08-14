<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Database\Factories\AdminHistoryFactory;

class AdminHistory extends Model
{
    use HasFactory;

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


