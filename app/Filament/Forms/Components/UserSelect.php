<?php
namespace App\Filament\Forms\Components;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Illuminate\Support\Collection;

class UserSelect extends Select
{
    public static function make(string $name = 'city_id'): static
    {
        return parent::make($name)
            ->label('Usuario')
            ->options(fn (Get $get): Collection => User::getNickAndNameById($get('user_id') ?? 0))
            ->searchable()
            ->searchDebounce(500)
            ->getSearchResultsUsing(fn (string $search) => User::searchByNickOrName($search))
            ->searchPrompt('Busca el Nick o el Nombre')
            ->noSearchResultsMessage('No se encontraron resultados');
    }
}
