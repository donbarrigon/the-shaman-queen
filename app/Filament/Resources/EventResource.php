<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar';
    protected static ?string $navigationGroup = 'Usuarios';
    protected static ?string $navigationLabel = 'Calendario de eventos';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->default('Orientación espiritual de ' . Auth::user()->nick)
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->default('Orientación espiritual programada por ' . Auth::user()->nick)
                            ->columnSpanFull(),
                        Forms\Components\ColorPicker::make('color')
                            ->default('#B91C1C')
                            ->required(),
                        Forms\Components\Select::make('created_by')
                            ->options([Auth::id() => Auth::user()->nick,]) // Usa el ID del usuario y su nick para saber quien iso la accion
                            ->default(Auth::id()) // Preselecciona el usuario autenticado
                            ->disabled()
                            ->dehydrated(true)
                            ->required(),
                        Forms\Components\DateTimePicker::make('start_at')
                            ->default(function () {
                                $now = Carbon::now()->timezone(config('app.timezone'))->addHour();
                                $minutes = $now->minute < 30 ? 30 : 0;
                                $now->setMinutes($minutes)->setSeconds(0);
                                return $now;
                            })
                            // ->reactive()
                            // ->afterStateUpdated(fn ($state, callable $set) =>
                            //     $set('end_at', Carbon::parse($state)->addHour())
                            // )
                            ->required(),
                        Forms\Components\DateTimePicker::make('end_at')
                            ->default(function () {
                                $now = Carbon::now()->timezone(config('app.timezone'))->addHours(2);
                                $minutes = $now->minute < 30 ? 30 : 0;
                                $now->setMinutes($minutes)->setSeconds(0);
                                return $now;
                            })
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->color(fn ($record) => $record->deleted_at ? 'danger' : ''),
                Tables\Columns\TextColumn::make('createdBy.nick')
                    ->label('Creado por')
                    ->sortable(),
                Tables\Columns\TextColumn::make('createdBy.roles.name')
                    ->label('Roles')
                    ->badge()
                    ->color(fn ($state) => $state === 'Guia espiritual' ? 'primary' : 'success')
                    ->separator(', '),
                Tables\Columns\TextColumn::make('start_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\ColorColumn::make('color')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(80)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make(),
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
            RelationManagers\AttendeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
