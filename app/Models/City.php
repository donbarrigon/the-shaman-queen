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
        // Limpiamos el input y lo dividimos en palabras clave
        $searchTerms = array_filter(array_map('trim', explode(' ', $search)));

        return $query
            ->select([
                'cities.id',
                DB::raw('CONCAT(cities.name, ", ", states.name, ", ", countries.name) as name')
            ])
            ->join('states', 'cities.state_id', '=', 'states.id')
            ->join('countries', 'states.country_id', '=', 'countries.id')
            ->where(function ($query) use ($searchTerms) {
                foreach ($searchTerms as $term) {
                    $term = "%{$term}%";
                    $query->where(function ($subQuery) use ($term) {
                        $subQuery->where('cities.name', 'LIKE', $term)
                            ->orWhere('states.name', 'LIKE', $term)
                            ->orWhere('countries.name', 'LIKE', $term);
                    });
                }
            })
            ->orderByRaw("
                CASE
                    WHEN cities.name LIKE ? THEN 100
                    WHEN states.name LIKE ? THEN 50
                    WHEN countries.name LIKE ? THEN 25
                    WHEN CONCAT(cities.name, ' ', states.name) LIKE ? THEN 90
                    WHEN CONCAT(cities.name, ' ', countries.name) LIKE ? THEN 80
                    WHEN CONCAT(states.name, ' ', countries.name) LIKE ? THEN 70
                    ELSE 0
                END DESC", array_fill(0, 6, "%{$search}%"))
            ->limit(20)
            ->pluck('name', 'id');
    }

    // public function scopeSearch($query, string $search)
    // {
    //     return $query
    //         ->select('cities.id', DB::raw('CONCAT(cities.name, ", ", states.name, ", ", countries.name) as name'))
    //         ->join('states', 'cities.state_id', '=', 'states.id')
    //         ->join('countries', 'states.country_id', '=', 'countries.id')
    //         ->where(function ($query) use ($search) {
    //             $query->where('cities.name', 'like', "%{$search}%")
    //                 ->orWhere('states.name', 'like', "%{$search}%")
    //                 ->orWhere('countries.name', 'like', "%{$search}%");
    //         })
    //         ->limit(20)
    //         ->pluck('name', 'id');
    // }
}
