<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipanteResource\Pages;
use App\Filament\Resources\ParticipanteResource\RelationManagers;
use App\Filament\Resources\ParticipanteResource\Widgets\ModalidadDeportivaWidget;
use App\Models\Nivel;
use App\Models\Participante;
use App\Models\Permiso;
use App\Models\Socio;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Component;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use function Pest\Laravel\options;

class ParticipanteResource extends Resource
{
    protected static ?string $model = Participante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Datos Personales')
                    ->schema([
                        Forms\Components\Select::make('id_entidad')
                            ->label('Club')
                            ->relationship('entidad', 'nombre')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull()
                            ->hidden(function (Set $set) {
                                $id_nivel = auth()->user()->id_nivel;
                                $id_entidad = auth()->user()->id_entidad;
                                $is_root = auth()->user()->is_root;
                                if ($id_nivel != 1 && !$is_root) {
                                    $set('id_entidad', $id_entidad);
                                    return true;
                                }
                                return false;
                            }),
                        Forms\Components\Fieldset::make()
                            ->schema([
                                Forms\Components\TextInput::make('cedula')
                                    ->label('Cédula')
                                    ->unique(ignoreRecord: true)
                                    ->live(onBlur: true)
                                    ->required()
                                    ->suffixIcon('heroicon-m-magnifying-glass')
                                    ->suffixIconColor('warning')
                                    ->maxLength(20)
                                    ->rules([
                                        fn(Get $get, Component $component): Closure => function (string $attribute, $value, Closure $fail) use ($get, $component) {
                                            $id_entidad = $get('id_entidad');
                                            $cedula = $value;
                                            $key = $component->getRecord()?->getKey();
                                            if (config('app.chequear_socios') && auth()->user()->validar_socios) {
                                                $exite = Socio::where('id_entidad', $id_entidad)->where('cedula', $cedula)->first();
                                                if (!$exite /*&& !$key*/) {
                                                    //$fail("The {$attribute} is invalid.");
                                                    $fail("La cedula no esta en el listado de Socios.");
                                                }
                                            }
                                        },
                                    ])
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state, Forms\Contracts\HasForms $livewire, Forms\Components\TextInput $input, Component $component) {
                                        $id_entidad = $get('id_entidad');
                                        $cedula = $state;
                                        $key = $component->getRecord()?->getKey();
                                        $exite = Socio::where('id_entidad', $id_entidad)->where('cedula', $cedula)->first();
                                        if ($exite) {
                                            $set('carnet_socio', $exite->carnet);
                                            $set('id_tipo_socio', $exite->tiposocio);
                                            $set('primer_nombre', $exite->primer_nombre);
                                            $set('segundo_nombre', $exite->segundo_nombre);
                                            $set('primer_apellido', $exite->primer_apellido);
                                            $set('segundo_apellido', $exite->segundo_apellido);
                                            $set('sexo', $exite->sexo);
                                            $set('fecha_nacimiento', $exite->fecha_nacimiento);
                                        } else {
                                            Notification::make()
                                                ->title('La cedula ' . $cedula)
                                                ->body('no esta en el listado de Socios')
                                                ->icon('heroicon-c-exclamation-circle')
                                                ->iconColor('warning')
                                                ->color('warning')
                                                ->persistent()
                                                ->send();
                                            if (!$key) {
                                                $set('carnet_socio', '');
                                                $set('id_tipo_socio', '');
                                                $set('primer_nombre', '');
                                                $set('segundo_nombre', '');
                                                $set('primer_apellido', '');
                                                $set('segundo_apellido', '');
                                                $set('sexo', '');
                                                $set('fecha_nacimiento', '');
                                            }
                                        }
                                        $livewire->validateOnly($input->getStatePath());
                                    }),

                                Forms\Components\TextInput::make('carnet_socio')
                                    ->label('Carnet')
                                    ->integer()
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\Select::make('id_tipo_socio')
                                    ->relationship('tipoSocio', 'tipo_socio')
                                    ->required(),
                            ])
                            ->columns(3),
                        Forms\Components\Fieldset::make()
                            ->schema([
                                Forms\Components\TextInput::make('primer_nombre')
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('segundo_nombre')
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('primer_apellido')
                                    ->required()
                                    ->maxLength(50),
                                Forms\Components\TextInput::make('segundo_apellido')
                                    ->maxLength(50),
                            ]),
                        Forms\Components\Fieldset::make()
                            ->schema([
                                Forms\Components\Select::make('sexo')
                                    ->options([
                                        0 => mb_strtoupper('Masculino'),
                                        1 => mb_strtoupper('Femenino'),
                                    ])
                                    ->required(),
                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('telefono')
                                    ->label('Teléfono')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                            ])
                            ->columns(3),
                        Forms\Components\Fieldset::make()
                            ->schema([
                                Forms\Components\DatePicker::make('fecha_nacimiento')
                                    ->label('Fecha de Nacimiento')
                                    ->required(),
                                Forms\Components\Select::make('deporteini')
                                    ->label('Deporte')
                                    ->relationship(
                                        'deporteinicial',
                                        'deporte',
                                        fn(Builder $query) => $query->where('en_uso', 1),
                                    )
                                    ->default(98)
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Forms\Components\Select::make('id_cargo')
                                    ->relationship(
                                        'cargo',
                                        'cargo',
                                        function (Builder $query) {
                                            $nivel = Nivel::find(auth()->user()->id_nivel);
                                            if ($nivel && !auth()->user()->is_root) {
                                                $id_permiso = $nivel->id_permiso;
                                                $permiso = Permiso::find($id_permiso);
                                                if ($permiso) {
                                                    $cargos = explode(',', $permiso->cargos);
                                                    foreach ($cargos as $cargo) {
                                                        $query->orWhere('id', $cargo);
                                                    }
                                                }
                                            }
                                            return $query;
                                        }
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                            ])
                            ->columns(3),
                        Forms\Components\Fieldset::make()
                            ->schema([
                                Forms\Components\FileUpload::make('fotografia')
                                    ->label('Foto tipo carnet del Participante')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(3072)
                                    ->directory('participantes-photos')
                                    ->required(),
                                Forms\Components\FileUpload::make('image_cedula')
                                    ->label('Foto del Carnet')
                                    ->image()
                                    ->imageEditor()
                                    ->maxSize(3072)
                                    ->directory('participantes-photos'),
                            ]),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->compact(),
                Forms\Components\Section::make('Datos Médicos')
                    ->schema([
                        Forms\Components\TextInput::make('rh')
                            ->label('Grupo Sanguineo y RH')
                            ->maxLength(50),
                        Forms\Components\Fieldset::make('Alergias')
                            ->schema([
                                Forms\Components\Toggle::make('alergico')
                                    ->label('Es alérgico')
                                    ->inline(false)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $isAlergico = $get('alergico');
                                        if (!$isAlergico) {
                                            $set('alergias', '');
                                        }
                                    }),
                                Forms\Components\TextInput::make('alergias')
                                    ->requiredIf('alergico', true)
                                    ->readOnly(fn(Get $get) => !$get('alergico')),
                            ]),
                        Forms\Components\Fieldset::make('Antecedentes Médicos')
                            ->schema([
                                Forms\Components\Toggle::make('ant_medicos')
                                    ->label('Con Antecedentes')
                                    ->inline(false)
                                    ->live()
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $ConAntecedentes = $get('ant_medicos');
                                        if (!$ConAntecedentes) {
                                            $set('antecedentes', '');
                                        }
                                    }),
                                Forms\Components\TextInput::make('antecedentes')
                                    ->requiredIf('ant_medicos', true)
                                    ->readOnly(fn(Get $get) => !$get('ant_medicos')),
                            ]),
                        Forms\Components\Fieldset::make('Avisar a')
                            ->schema([
                                Forms\Components\TextInput::make('avisar_a')
                                    ->label('Nombre')
                                    ->maxLength(100),
                                Forms\Components\TextInput::make('telefono_medico')
                                    ->label('Teléfono')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                            ]),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->compact(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('cedula')
                    ->numeric()
                    ->searchable(),
                Tables\Columns\TextColumn::make('primer_nombre')
                    ->label('Nombres')
                    ->formatStateUsing(function ($state, Participante $participante) {
                        return mb_strtoupper($participante->primer_nombre . ' ' . $participante->segundo_nombre);
                    })
                    ->searchable()
                    ->wrap()
                    ->visibleFrom('sm'),
                Tables\Columns\TextColumn::make('primer_apellido')
                    ->label('Apellidos')
                    ->formatStateUsing(function ($state, Participante $participante) {
                        return mb_strtoupper($participante->primer_apellido . ' ' . $participante->segundo_apellido);
                    })
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('sexo')
                    ->label('Sexo')
                    ->formatStateUsing(function ($state, Participante $participante) {
                        if (!$participante->sexo) {
                            return mb_strtoupper('Masculino');
                        } else {
                            return mb_strtoupper('Femenino');
                        }
                    })
                    ->visibleFrom('sm')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('deporteinicial.deporte')
                    ->label('Deporte')
                    ->wrap()
                    ->formatStateUsing(fn(string $state) => mb_strtoupper($state))
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cargo.cargo')
                    ->label('Cargo')
                    ->formatStateUsing(fn(string $state) => mb_strtoupper($state))
                    ->wrap()
                    ->visibleFrom('sm'),
                Tables\Columns\CheckboxColumn::make('asiste')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('entidad.short_nombre')
                    ->label('Club')
                    ->formatStateUsing(fn(string $state) => mb_strtoupper($state))
                    ->wrap()
                    ->hidden(function () {
                        $id_nivel = auth()->user()->id_nivel;
                        $is_root = auth()->user()->is_root;
                        if ($id_nivel != 1 && !$is_root) {
                            return true;
                        }
                        return false;
                    })
                    ->visibleFrom('sm')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('Deporte')
                    ->relationship('deporteinicial', 'deporte'),
                Tables\Filters\SelectFilter::make('Cargo')
                    ->relationship('cargo', 'cargo'),
                Tables\Filters\SelectFilter::make('Entidad')
                    ->label('Club')
                    ->relationship('entidad', 'short_nombre')
                    ->hidden(function () {
                        $id_nivel = auth()->user()->id_nivel;
                        $is_root = auth()->user()->is_root;
                        if ($id_nivel != 1 && !$is_root) {
                            return true;
                        }
                        return false;
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    //Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('imprimir')
                        ->label('Imprimir')
                        ->icon('heroicon-o-identification')
                        ->url(fn(Participante $record) => route('export.participante', $record->getKey()))
                        ->openUrlInNewTab(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                        ->before(function ($record) {
                            $i = 0;
                            do {
                                $repeat = Str::repeat('*', ++$i);
                                $cedula = $repeat . $record->cedula;
                                $existe = Participante::withTrashed()->where('cedula', $cedula)->first();
                            } while ($existe);
                            $record->update(['cedula' => $cedula]);
                        })
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function (Collection $records) {
                            foreach ($records as $record) {
                                $i = 0;
                                do {
                                    $repeat = Str::repeat('*', ++$i);
                                    $cedula = $repeat . $record->cedula;
                                    $existe = Participante::withTrashed()->where('cedula', $cedula)->first();
                                } while ($existe);
                                $record->update(['cedula' => $cedula]);
                            }
                        })
                ]),
                ExportBulkAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('cedula'),
                        Column::make('primer_nombre'),
                        Column::make('segundo_nombre'),
                        Column::make('primer_apellido'),
                        Column::make('segundo_apellido'),
                        Column::make('sexo')
                            ->formatStateUsing(function ($state, Participante $participante) {
                                if (!$participante->sexo) {
                                    return mb_strtoupper('Masculino');
                                } else {
                                    return mb_strtoupper('Femenino');
                                }
                            }),
                        Column::make('deporteinicial.deporte')->heading('Deporte'),
                        Column::make('cargo.cargo')->heading('Cargo'),
                        Column::make('entidad.short_nombre')->heading('Club'),
                    ])
                ])
            ])
            ->defaultSort('created_at', 'DESC')
            ->modifyQueryUsing(function (Builder $query) {
                $id_nivel = auth()->user()->id_nivel;
                $id_entidad = auth()->user()->id_entidad;
                $is_root = auth()->user()->is_root;
                if ($id_nivel != 1 && !$is_root) {
                    return $query->where('id_entidad', $id_entidad);
                }
            });
    }

    public static function getRelations(): array
    {
        return [
            //RelationManagers\AtletasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParticipantes::route('/'),
            'create' => Pages\CreateParticipante::route('/create'),
            'edit' => Pages\EditParticipante::route('/{record}/edit'),
            //'view' => Pages\ViewParticipante::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ModalidadDeportivaWidget::class,
        ];
    }

    public static function canAccess(): bool
    {
        $id_nivel = auth()->user()->id_nivel ?? null;
        $is_root = auth()->user()->is_root ?? null;
        return verPage('PARTICIPANTES_VER', 'PARTICIPANTES_HASTA') || $id_nivel == 1 || $is_root;
    }





}
