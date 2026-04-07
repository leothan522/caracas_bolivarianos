<?php

namespace App\Livewire;

use App\Models\Entidad;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Livewire;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Str;
use Livewire\Component;

class NumericaInfolistComponent extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public int $id_entidad;
    public string $nombre_entidad;

    public function mount()
    {
        $this->filtrarEntidad();
    }

    public function render()
    {
        return view('livewire.numerica-infolist-component');
    }

    public function intencionInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([])
            ->schema([
                Section::make('Deportes y Modalidades')
                    ->description('Seleccione las modalidades e indique cuentos participaran segun su genero.')
                    ->schema([
                        Livewire::make(NumericaTableComponent::class, [
                            'id_entidad' => $this->id_entidad ?? null
                        ])
                            ->key('foo-first')
                    ])
                    ->headerActions([
                        Action::make('seleccionar_entidad')
                            ->label(Str::upper($this->nombre_entidad))
                            ->form([
                                Select::make('id_entidad')
                                    ->label(Str::upper('club'))
                                    ->options(Entidad::query()->where('is_delegacion', 1)->where('activo', 1)->pluck('short_nombre', 'id'))
                                    ->searchable()
                                    ->preload()
                                    //->required()
                                    ->default($this->id_entidad ?? null),
                            ])
                            ->modalWidth(MaxWidth::Small)
                            ->action(function (array $data): void {
                                if (!isset($data['id_entidad'])){
                                    $this->reset('id_entidad');
                                    $this->nombre_entidad = 'Seleccionar CLUB';
                                }else{
                                    $this->setEntidad($data['id_entidad']);
                                }
                                $this->dispatch('cambiarValorEntidad', id: $this->id_entidad ?? null);

                            })
                            ->hidden($this->ocultar()),
                        Action::make('imprimir')
                            ->label('Generar PDF')
                            ->url(fn(): string => route('intencion.numerica', $this->id_entidad ?? null))
                            //->disabled(!isset($this->id_entidad))
                            ->openUrlInNewTab()
                    ])
                    ->compact()
            ]);
    }

    protected function filtrarEntidad(): void
    {
        $this->nombre_entidad = 'Seleccionar CLUB';
        $id_entidad = auth()->user()->id_entidad;
        $id_nivel = auth()->user()->id_nivel;
        $is_root = auth()->user()->is_root;
        if ($id_entidad && $id_nivel != 1 && !$is_root) {
            $this->setEntidad($id_entidad);
        }
    }

    protected function setEntidad($id): void
    {
        $entidad = Entidad::find($id);
        if ($entidad) {
            $this->id_entidad = $entidad->id;
            $this->nombre_entidad = $entidad->short_nombre;
        }
    }

    protected function ocultar(): bool
    {
        $response = true;
        $id_nivel = auth()->user()->id_nivel;
        $is_root = auth()->user()->is_root;
        if ($id_nivel == 1 || $is_root) {
            $response = false;
        }
        return $response;
    }

}
