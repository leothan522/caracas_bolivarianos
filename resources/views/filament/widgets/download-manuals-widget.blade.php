<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        <div class="flex flex-col gap-y-4 sm:flex-row sm:items-center sm:justify-between sm:gap-x-4">
            <div class="flex-1">
                <h2 class="text-lg font-bold tracking-tight text-gray-950 dark:text-white">
                    Manuales Técnicos
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Paquete comprimido con los manuales técnicos de las disciplinas en formato PDF.
                </p>
            </div>

            <div class="flex shrink-0">
                <x-filament::button
                    wire:click="download"
                    icon="heroicon-o-folder-arrow-down"
                    color="info"
                    tag="button"
                    class="w-full sm:w-auto"
                >
                    Descargar .ZIP
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
