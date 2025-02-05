<?php
namespace App\Filament\Forms\Components;

use App\Models\City;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class CitySelect extends Select
{
    public static function make(string $name = 'city_id'): static
    {
        return parent::make($name)
            ->label('Ciudad')
            ->options(fn (Get $get): Collection => City::fullName($get('city_id') ?? 0))
            ->searchable()
            ->searchDebounce(500)
            ->getSearchResultsUsing(fn (string $search) => City::search($search))
            ->searchPrompt('Busca ciudad, estado o país')
            ->noSearchResultsMessage('No se encontraron resultados');
    }
}
