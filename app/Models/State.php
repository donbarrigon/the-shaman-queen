<?php

namespace App\Models;

use Altwaireb\World\Models\State as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;
    //
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
