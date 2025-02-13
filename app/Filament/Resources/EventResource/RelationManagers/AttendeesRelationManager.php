<?php

namespace App\Filament\Resources\EventResource\RelationManagers;

use App\Filament\Forms\Components\UserSelect;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AttendeesRelationManager extends RelationManager
{
    protected static string $relationship = 'attendees';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('event_id')
                    ->default(fn ($livewire) => $livewire->ownerRecord->id)
                    ->disabled()
                    ->dehydrated(true)
                    ->required(),

                Section::make('Asistentes')
                    ->description('Agrega un asistente y su rol')
                    ->schema([
                        UserSelect::make('user_id')
                            ->required(),

                        Forms\Components\Select::make('role')
                            ->label('Rol en el evento')
                            ->options([
                                'Organizador' => 'Organizador',
                                'Guia espiritual' => 'Guía espiritual',
                                'Consultante' => 'Consultante',
                                'Colaborador' => 'Colaborador',
                                'Invitado' => 'Invitado',
                            ])
                            ->default('Consultante')
                            ->required(),

                        Forms\Components\Toggle::make('confirmed')
                            ->default(false),
                    ]),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('event.name')
            ->columns([
                // Tables\Columns\TextColumn::make('event.name')
                //     ->sortable()
                //     ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Rol en el evento')
                    ->badge()
                    ->color(function ($state) {
                        $colors = [
                            'Organizador' => 'info',
                            'Guia espiritual' => 'primary',
                            'Consultante' => 'success',
                            'Colaborador' => 'warning',
                            'Invitado' => 'gray',
                        ];
                        return $colors[$state] ?? 'gray';
                    }),

                Tables\Columns\IconColumn::make('confirmed')
                    ->boolean(),

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
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar Usuarios'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
