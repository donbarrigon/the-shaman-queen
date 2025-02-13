<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'color',
        'created_by',
        'start_at',
        'end_at',
    ];

    /**
     * Get the user con rol cliente
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Get all of the comments for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendees(): HasMany
    {
        return $this->hasMany(EventAttendee::class);
    }

}
