<?php

namespace App\Filament\Resources\ParticipanteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AtletasRelationManager extends RelationManager
{
    protected static string $relationship = 'atletas';
    protected static ?string $title = 'Deportes y Modalidades';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('cedula')
                    ->default(function (RelationManager $livewire): string {
                        return $livewire->getOwnerRecord()->cedula;
                    }),
                Forms\Components\Select::make('id_deporte')
                    ->label('Deporte')
                    ->relationship(
                        'deporte',
                        'deporte',
                        fn(Builder $query, Get $get) => $query->where('en_uso', 1))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn(Set $set) => $set('id_modalidad', '')),
                Forms\Components\Select::make('id_modalidad')
                    ->label('Modalidad')
                    ->relationship(
                        'modalidad',
                        'modalidad',
                        function (Builder $query, Get $get, RelationManager $livewire){
                            $query->where('id_deporte', $get('id_deporte'));
                            $sexo = $livewire->getOwnerRecord()->sexo;
                            $fecha_nacimiento = $livewire->getOwnerRecord()->fecha_nacimiento;
                            if ($sexo){
                                $query->where('femenino', 1);
                            }else{
                                $query->where('masculino', 1);
                            }
                            return $query->where('puntuable', 1)
                                ->where('en_practica', 1)
                                ->where('rango_minimo', '>=', $fecha_nacimiento)
                                ->where('rango_maximo', '<=', $fecha_nacimiento);
                        }
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('marca')
                    ->label('Marca Personal'),
                Forms\Components\TextInput::make('obs')
                    ->label('Observaciones'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('cedula')
            ->columns([
                Tables\Columns\TextColumn::make('deporte.deporte')
                    ->searchable(),
                Tables\Columns\TextColumn::make('modalidad.modalidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marca')
                    ->label('Marca Personal')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('obs')
                    ->label('Observaciones')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Agregar')
                    ->modalHeading('Agregar Deporte y Modalidad')
                    ->disabled(function (RelationManager $livewire){
                        if ($livewire->getOwnerRecord()->fecha_nacimiento){
                            return false;
                        }
                        return true;
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
