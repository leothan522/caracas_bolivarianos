<?php

namespace App\Livewire;

use App\Models\Deporte;
use Livewire\Component;

class ReporteDeporteListComponent extends Component
{
    public bool $modalidad;

    public function mount($modalidad = false)
    {
        $this->modalidad = $modalidad;
    }

    public function render()
    {
        $deportes = Deporte::where('en_uso', 1)->get();
        return view('livewire.reporte-deporte-list-component')
            ->with('listarDeportes', $deportes);
    }
}
