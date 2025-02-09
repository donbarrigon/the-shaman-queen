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
            ->options(fn (): Collection => User::GetListGuiaEspiritual())
            ->searchable();
            // ->searchDebounce(500)
            // ->getSearchResultsUsing(fn (string $search) => User::searchGuiaEspiritual($search))
            // ->searchPrompt('Busca por Alias o nombre')
            // ->noSearchResultsMessage('No se encontraron resultados');
    }
}
