<?php

namespace App\Models;

use Altwaireb\World\Models\City as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class City extends Model
{
    use SoftDeletes;

    public function scopeFullName($query, string $search)
    {
        $results = $query
            ->select('cities.id', DB::raw('CONCAT(cities.name, ", ", states.name, ", ", countries.name) as name'))
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->where('cities.id', $search)
            ->limit(1)
            ->pluck('name', 'id');
        return $results->isEmpty() ? collect(['0' => 'Busca ciudad, estado o país']) : $results;
    }


    public function scopeSearch($query, string $search)
    {
        return $query
            ->select('cities.id', DB::raw('CONCAT(cities.name, ", ", states.name, ", ", countries.name) as name'))
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->where(function ($query) use ($search) {
                $query->where('cities.name', 'like', "%{$search}%")
                    ->orWhere('states.name', 'like', "%{$search}%")
                    ->orWhere('countries.name', 'like', "%{$search}%");
            })
            ->limit(100)
            ->pluck('name', 'id');
    }
}
