<?php

namespace App\Livewire;

use App\Models\Entidad;
use App\Models\ModalidadDeportiva;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Str;
use Livewire\Component;

class ReporteModalidadInfolistComponent extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public int $id_deporte;
    public string $nombre_deporte;
    public bool $display = true;

    public function moutn($id_deporte, $nombre_deporte)
    {
        $this->id_deporte = $id_deporte;
        $this->nombre_deporte = $nombre_deporte;
    }


    public function render()
    {
        return view('livewire.reporte-modalidad-infolist-component');
    }

    public function deportesInfoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'modalidades' => $this->getModalidades()->get()
            ])
            ->schema([
                Section::make($this->nombre_deporte)
                    ->description(function (): string {
                        $modalidades = $this->getModalidades();
                        return "Modalidades " . $modalidades->count();
                    })
                    ->headerActions([
                        Action::make('imprimir_deporte_'.$this->id_deporte)
                            ->label('Generar PDF')
                            ->url(function (): string {
                                $id_entidad = auth()->user()->id_entidad ?? -1;
                                return route('export.deporte', [$id_entidad, 'all', $this->id_deporte]);
                            })
                            ->openUrlInNewTab()
                            ->hidden(!$this->filtrarEntidad())
                            ->disabled(!$this->filtrarEntidad()),
                        Action::make('imprimir_deporte_entidad_'.$this->id_deporte)
                            ->label('Generar PDF')
                            ->form([
                                Select::make('id_entidad')
                                    ->label(Str::upper('Club'))
                                    ->options(function (): array {
                                        $options = Entidad::query()->pluck('short_nombre', 'id')->toArray();
                                        $options['all'] = "TODOS";
                                        return $options;
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Select::make('filtro')
                                    ->options([
                                        'all' => 'TODOS',
                                        1 => 'ASISTE',
                                        0 => 'NO ASISTE'
                                    ])
                                    ->default('all')
                                    ->required(),
                            ])
                            ->modalWidth(MaxWidth::Small)
                            ->action(function (Component $livewire, array $data) {
                                $url = route('export.deporte', [$data['id_entidad'], $data['filtro'], $this->id_deporte]);
                                return $livewire->dispatch('generarpdfentidad-' . $this->id_deporte, url: $url);
                            })
                            ->hidden($this->filtrarEntidad())
                            ->disabled($this->filtrarEntidad()),
                    ])
                    ->schema([
                        RepeatableEntry::make('modalidades')
                            ->label('')
                            ->schema([
                                TextEntry::make('modalidad')
                                    ->label('')
                                    ->suffixAction(function (ModalidadDeportiva $record): array{
                                        return [
                                            Action::make('imprimir_modalidad_'.$record->id)
                                                ->label('Generar PDF')
                                                ->icon('heroicon-c-document-arrow-down')
                                                ->url(function (ModalidadDeportiva $record): string {
                                                    $id_entidad = auth()->user()->id_entidad ?? -1;
                                                    return route('export.modalidad', [$id_entidad, 'all', $record->id]);
                                                })
                                                ->openUrlInNewTab()
                                                ->hidden(!$this->filtrarEntidad())
                                                ->disabled(!$this->filtrarEntidad()),
                                            Action::make('imprimir_modalidad_entidad_'.$record->id)
                                                ->label('Generar PDF')
                                                ->icon('heroicon-c-document-arrow-down')
                                                ->form([
                                                    Select::make('id_entidad')
                                                        ->label(Str::upper('Club'))
                                                        ->options(function (): array {
                                                            $options = Entidad::query()->pluck('short_nombre', 'id')->toArray();
                                                            $options['all'] = "TODOS";
                                                            return $options;
                                                        })
                                                        ->searchable()
                                                        ->preload()
                                                        ->required(),
                                                    Select::make('filtro')
                                                        ->options([
                                                            'all' => 'TODOS',
                                                            1 => 'ASISTE',
                                                            0 => 'NO ASISTE'
                                                        ])
                                                        ->default('all')
                                                        ->required(),
                                                ])
                                                ->modalWidth(MaxWidth::Small)
                                                ->action(function (Component $livewire, array $data, ModalidadDeportiva $record) {
                                                    $url = route('export.modalidad', [$data['id_entidad'], $data['filtro'], $record->id]);
                                                    return $livewire->dispatch('generarpdfentidad-' . $this->id_deporte, url: $url);
                                                })
                                                ->hidden($this->filtrarEntidad())
                                                ->disabled($this->filtrarEntidad()),
                                        ];
                                    }),
                            ])
                    ])
                    ->compact()
                    ->collapsed()
                    ->extraAttributes(function () {
                        return [
                            'x-on:generarpdfentidad-' . $this->id_deporte . '.window' => 'window.open(event.detail.url)',
                        ];
                    }),
            ]);
    }

    protected function getModalidades(): \Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\_IH_ModalidadDeportiva_QB
    {
        $query = ModalidadDeportiva::query();
        $query->where('id_deporte', $this->id_deporte)
            ->where('puntuable', 1)
            ->where('en_practica', 1)
            ->orderBy('id_deporte');
        return $query;
    }

    protected function filtrarEntidad(): bool
    {
        $response = false;
        $id_nivel = auth()->user()->id_nivel;
        $is_root = auth()->user()->is_root;
        if ($id_nivel != 1 && !$is_root) {
            $response = true;
        }
        return $response;
    }

}
