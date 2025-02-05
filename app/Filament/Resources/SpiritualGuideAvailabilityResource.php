<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpiritualGuideAvailabilityResource\Pages;
use App\Filament\Resources\SpiritualGuideAvailabilityResource\RelationManagers;
use App\Models\SpiritualGuideAvailability;
use App\Filament\Forms\Components\SpiritualGuideSelect;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpiritualGuideAvailabilityResource extends Resource
{
    protected static ?string $model = SpiritualGuideAvailability::class;

    protected static ?string $navigationIcon = 'heroicon-s-clock';
    protected static ?string $navigationGroup = 'Usuarios';
    protected static ?string $navigationLabel = 'Disponibilidad';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SpiritualGuideSelect::make('user_id')
                    ->label('Guia espiritual')
                    ->required(),
                Forms\Components\TextInput::make('day')
                    ->label('Día de la semana')
                    ->required(),
                Forms\Components\Section::make('Rango Horario')
                    ->description('Defina el rango habil para recibir consultas (no toma en cuenta el tiempo que tarda la consulta) solo limita la hora de inicio')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TimePicker::make('start_at')
                            ->label('Inicio')
                            ->required(),
                        Forms\Components\TimePicker::make('end_at')
                            ->label('Fin')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day'),
                Tables\Columns\TextColumn::make('start_at'),
                Tables\Columns\TextColumn::make('end_at'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSpiritualGuideAvailabilities::route('/'),
            'create' => Pages\CreateSpiritualGuideAvailability::route('/create'),
            'edit' => Pages\EditSpiritualGuideAvailability::route('/{record}/edit'),
        ];
    }
}
