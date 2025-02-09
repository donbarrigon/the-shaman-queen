<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nick',
        'phone',
        'address',
        'city_id',
        'postal_code',
        'address_complement',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function scopeGetListGuiaEspiritual() {
        return User::role('Guía Espiritual')
            ->select('users.id', DB::raw('CONCAT(users.name, " - ", users.nick) as name'))
            ->pluck('name', 'id');
    }

    public function scopeSearchGuiaEspiritual($query, string $search)
    {
        return $query
            ->role('Guía Espiritual')
            ->select('users.id', DB::raw('CONCAT(users.name, " - ", users.nick) as name'))
            ->where(function($q) use ($search) {
                $q->where('users.name', 'like', '%' . $search . '%')
                ->orWhere('users.nick', 'like', '%' . $search . '%');
            })
            ->limit(20)
            ->pluck('name', 'id');
    }
}
