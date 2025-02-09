<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpiritualGuideAvailability extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'day',
        'start_at',
        'end_at',
        'session_duration',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
