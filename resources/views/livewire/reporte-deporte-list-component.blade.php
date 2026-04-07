<div>
    {{-- The Master doesn't talk, he acts. --}}
    @foreach($listarDeportes as $deporte)
        @if(!$modalidad)
            <livewire:reporte-general-infolist-component
                title="{{ $deporte->deporte }}"
                id_deporte="{{ $deporte->id }}"
            />
            <br>
        @else
            <livewire:reporte-modalidad-infolist-component
                id_deporte="{{ $deporte->id }}"
                nombre_deporte="{{ $deporte->deporte }}"
            />
        @endif
    @endforeach
</div>
