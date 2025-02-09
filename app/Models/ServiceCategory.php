<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'long_description',
        'image_url',
        'slug',
    ];

    public function scopeGetList() {
        return ServiceCategory::all()->pluck('name', 'id');
    }
}
