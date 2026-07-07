<?php

namespace App\Livewire;

use App\Models\Participante;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use function Laravel\Prompts\text;

class ReporteGeneralTableComponent extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public bool $filtrar_entidad;
    public int $id_entidad;
    public string $texto;
    public int $id_deporte;

    public function mount(bool $filtrar_entidad, int $id_entidad, string $texto)
    {
        $this->filtrar_entidad = $filtrar_entidad;
        $this->id_entidad = $id_entidad;
        $this->texto = $texto;
    }

    public function render()
    {
        return view('livewire.reporte-general-table-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Participante::query())
            ->modifyQueryUsing(function (Builder $query) {
                // 1. Filtro opcional por entidad del componente
                if ($this->filtrar_entidad) {
                    $query->where('id_entidad', $this->id_entidad);
                }

                if ($this->id_deporte){
                    //$query->where('deporteini', $this->id_deporte);
                    // 2. Filtramos la tabla participantes basándonos en sus registros de la tabla atletas
                    $query->whereHas('atletas', function (Builder $atletaQuery) {
                        // Condición obligatoria: El deporte asociado al atleta debe estar en uso
                        $atletaQuery->whereHas('deporte', function (Builder $deporteQuery) {
                            $deporteQuery->where('en_uso', 1);
                        });

                        // Si el componente tiene un deporte seleccionado, filtramos por ese ID específico
                        $atletaQuery->where('id_deporte', $this->id_deporte);
                    });


                }else{
                    $query->whereRelation('deporteinicial', 'en_uso', 1);
                }

                return $query;
            })
            ->columns([
                TextColumn::make('cedula')
                    ->numeric()
                    ->searchable(),
                TextColumn::make('primer_nombre')
                    ->label('Nombre Completo')
                    ->formatStateUsing(function ($state, Participante $participante) {
                        return mb_strtoupper($participante->primer_nombre . ' ' . $participante->segundo_nombre . ' ' . $participante->primer_apellido . ' ' . $participante->segundo_apellido);
                    })
                    ->wrap(),
                TextColumn::make('fecha_nacimiento')
                    ->date('d/m/Y')
                    ->visibleFrom('sm')
                    ->alignEnd(),
                TextColumn::make('cargo.cargo')
                    ->label('Cargo')
                    ->formatStateUsing(fn(string $state) => mb_strtoupper($state))
                    ->wrap()
                    ->visibleFrom('sm'),
                TextColumn::make('entidad.short_nombre')
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
                    ->visibleFrom('sm'),
            ])
            ->filters([
                SelectFilter::make('id_entidad')
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
                SelectFilter::make('Cargo')
                    ->relationship('cargo', 'cargo', function (Builder $query) {
                        // 1. Obtener el usuario autenticado con sus relaciones cargadas
                        $user = auth()->user()?->load('nivel.permiso');

                        // 2. Si no hay usuario o no tiene permisos asignados, vaciamos el select por seguridad
                        if (!$user || !$user->nivel || !$user->nivel->permiso || empty($user->nivel->permiso->cargos)) {
                            return $query->whereRaw('1 = 0'); // Consulta que devuelve vacío
                        }

                        // 3. Limpiamos el string ("1, 2, , 3") y lo convertimos en un array limpio: [1, 2, 3]
                        $cargoIds = array_filter(
                            array_map('trim', explode(',', $user->nivel->permiso->cargos))
                        );

                        // Si después de limpiar el array quedó vacío, no mostramos nada
                        if (empty($cargoIds)) {
                            return $query->whereRaw('1 = 0');
                        }

                        // 4. Filtramos el listado del SELECT para que solo muestre esos IDs
                        return $query->whereIn('id', $cargoIds);
                    })
                    ->hidden($this->id_deporte)
            ])
            ->queryStringIdentifier($this->texto);
    }


}
