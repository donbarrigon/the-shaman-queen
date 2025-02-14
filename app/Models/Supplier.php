<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'nit',
        'phone',
        'website',
        'email',
        'address',
        'city_id'
    ];

    public function contacts() :HasMany
    {
        return $this->hasMany(SupplierContacts::class);
    }
}
