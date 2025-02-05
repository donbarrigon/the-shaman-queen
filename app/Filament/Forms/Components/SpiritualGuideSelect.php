<?php
namespace App\Filament\Forms\Components;

use App\Models\City;
use Filament\Forms\Components\Select;
use App\Models\User;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class SpiritualGuideSelect extends Select
{
    public static function make(string $name = 'user_id'): static
    {
        return parent::make($name)
            ->label('Guia Espiritual')
            ->options(fn (Get $get): Collection => City::fullName($get('city_id') ?? 0))
            ->searchable()
            ->searchDebounce(500)
            ->getSearchResultsUsing(fn (string $search) => City::search($search))
            ->searchPrompt('Busca ciudad, estado o país')
            ->noSearchResultsMessage('No se encontraron resultados');
    }
}
