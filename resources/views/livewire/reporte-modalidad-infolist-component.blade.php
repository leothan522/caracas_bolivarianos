<div>
    {{-- Be like water. --}}
    @if($display)
        {{ $this->deportesInfoList }}
        <br>
    @endif
    <x-filament-actions::modals />
</div>
