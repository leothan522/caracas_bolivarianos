<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IntencionParticipacionResource\Pages;
use App\Filament\Resources\IntencionParticipacionResource\RelationManagers;
use App\Models\DeporteOficial;
use App\Models\Entidad;
use App\Models\IntencionParticipacion;
use App\Models\ParticipacionDisciplina;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Livewire;

class IntencionParticipacionResource extends Resource
{
    protected static ?string $model = DeporteOficial::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Intención de Participación';
    protected static ?string $modelLabel = 'Intención de Participación';
    protected static ?string $pluralModelLabel = 'Intención de Participación';
    protected static bool $hasTitleCaseModelLabel = false;

    protected static ?string $slug = 'intencion-de-participacion';

    /*public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }*/

    public static int|null $id_entidad = null;
    public static string|null $nombre_entidad = null;

    public static function table(Table $table): Table
    {
        self::filtrarEntidad();
        return $table
            ->query(function (): Builder {
                $query = DeporteOficial::query();
                return $query->select('deportes_oficiales.*')
                    ->join('deportes', 'deportes.id', '=', 'deportes_oficiales.id_deporte')
                    ->orderBy('deportes.deporte', 'asc')->orderBy('ordenar', 'asc');
            })
            ->heading('Deportes y Modalidades')
            ->description('Seleccione todas competiciones en las que su club desea competir')
            ->columns([
                TextColumn::make('deporte_sm')
                    ->label('Deporte')
                    ->default(fn(DeporteOficial $record) => $record->deporte->deporte ?? null)
                    ->description(fn(DeporteOficial $record) => $record->genero)
                    ->hiddenFrom('md'),
                TextColumn::make('deporte.deporte')
                    ->searchable()
                    ->wrap()
                    ->visibleFrom('md'),
                TextColumn::make('categoria')
                    ->description(function (DeporteOficial $record): string {
                        $response = "";

                        if (!$record->edad_libre) {
                            $response = "($record->edad_inicial a $record->edad_final)";
                        }

                        return $response;
                    })
                    ->searchable()
                    ->wrap()
                    ->alignCenter(),
                TextColumn::make('min')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('max')
                    ->numeric()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('genero')
                    ->alignCenter()
                    ->visibleFrom('md'),
            ])
            ->filters([
                SelectFilter::make('deporte')
                    ->relationship(
                        'deporte',
                        'deporte',
                        fn(Builder $query) => $query->has('oficiales'),
                    )
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\Action::make('seleccionar')
                    ->iconButton()
                    ->icon(function (DeporteOficial $record): string {
                        $response = 'heroicon-o-stop';
                        if (self::getParticipacion($record)) {
                            $response = 'heroicon-m-check-circle';
                        }
                        return $response;
                    })
                    ->modalHeading(fn(DeporteOficial $record): string => $record->deporte->deporte ?? null)
                    ->modalDescription(fn(DeporteOficial $record): string => $record->categoria)
                    ->modalWidth(MaxWidth::Small)
                    ->fillForm(function (DeporteOficial $record): array {
                        $response = [];
                        $intencion = self::getParticipacion($record);
                        if ($intencion) {
                            $response = [
                                'femenino' => $intencion->femenino,
                                'masculino' => $intencion->masculino
                            ];
                        }
                        return $response;
                    })
                    ->form([
                        TextInput::make('femenino')
                            ->integer()
                            ->minValue(0),
                        TextInput::make('masculino')
                            ->integer()
                            ->minValue(0),
                    ])
                    ->action(function (array $data, DeporteOficial $record): void {
                        if (self::$id_entidad) {
                            $intencion = self::getParticipacion($record);
                            if ($data['femenino'] || $data['masculino']) {
                                if (!$intencion) {
                                    $intencion = new ParticipacionDisciplina();
                                    $intencion->id_entidad = self::$id_entidad;
                                    $intencion->id_deporte_oficial = $record->id;
                                }
                                $intencion->femenino = $data['femenino'];
                                $intencion->masculino = $data['masculino'];
                                $intencion->save();
                            } else {
                                $intencion?->delete();
                            }
                        } else {
                            Notification::make()
                                ->title('Falta Seleccionar CLUB')
                                ->warning()
                                ->color('warning')
                                ->persistent()
                                ->send();
                        }
                    })
            ], position: Tables\Enums\ActionsPosition::BeforeCells)
            ->headerActions([
                Tables\Actions\Action::make('seleccionar_entidad')
                    // El closure permite que al refrescar la tabla, el label se actualice
                    ->label(fn() => session('entidad_nombre', 'Seleccionar CLUB'))
                    ->form([
                        Select::make('id_entidad')
                            ->label(Str::upper('club'))
                            ->options(Entidad::query()->where('is_delegacion', 1)->where('activo', 1)->pluck('short_nombre', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->default(self::$id_entidad)
                    ])
                    ->action(function (array $data, $livewire): void {
                        self::setEntidad($data['id_entidad']);
                        $livewire->dispatch('refreshTable');
                    })
                    ->modalWidth(MaxWidth::ExtraSmall)
                    ->hidden(self::ocultar()),
                Tables\Actions\Action::make('imprimir')
                    ->label('Generar PDF')
                    ->url(fn() => route('intencion.deporte', session('entidad_id', null)))
                    ->disabled(empty(session('entidad_id')))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('actualizar')
                    ->iconButton()
                    ->icon('heroicon-o-arrow-path'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageIntencionParticipacions::route('/'),
        ];
    }

    protected static function filtrarEntidad(): void
    {
        // 1. Intentamos recuperar el nombre de la sesión para el label del botón
        self::$nombre_entidad = session('entidad_nombre', 'Seleccionar CLUB');
        self::$id_entidad = session('entidad_id');

        $id_entidad = auth()->user()->id_entidad;
        $id_nivel = auth()->user()->id_nivel;
        $is_root = auth()->user()->is_root;

        if ($id_entidad && $id_nivel != 1 && !$is_root) {
            self::setEntidad($id_entidad);
        }
    }

    protected static function setEntidad($id): void
    {
        $entidad = Entidad::find($id);
        if ($entidad) {
            self::$id_entidad = $entidad->id;
            self::$nombre_entidad = $entidad->short_nombre;
            // 2. Guardamos en la sesión para que sobreviva al refresco
            session([
                'entidad_id' => $entidad->id,
                'entidad_nombre' => $entidad->short_nombre,
            ]);
        }
    }

    protected static function ocultar(): bool
    {
        $response = true;
        $id_nivel = auth()->user()->id_nivel;
        $is_root = auth()->user()->is_root;
        if ($id_nivel == 1 || $is_root) {
            $response = false;
        }
        return $response;
    }

    protected static function getParticipacion($record): ?ParticipacionDisciplina
    {
        return ParticipacionDisciplina::where('id_entidad', self::$id_entidad)
            ->where('id_deporte_oficial', $record->id)
            ->first();
    }

    public static function canAccess(): bool
    {
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        return verPage('INTENCION_DEPORTE_VER', 'INTENCION_DEPORTE_HASTA') ||
            (!verPage('INTENCION_VER', 'INTENCION_HASTA') && ($id_nivel == 1 || $is_root));
    }

}
