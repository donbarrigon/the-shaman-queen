<?php

namespace App\Models;

use Altwaireb\World\Models\Country as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;
}
