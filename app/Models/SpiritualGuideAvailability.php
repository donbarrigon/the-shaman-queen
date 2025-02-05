<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpiritualGuideAvailability extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'days',
        'start_at',
        'end_at',
        'session_duration',
    ];
}
