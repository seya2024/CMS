<x-filament-widgets::widget>
    <x-filament::section>
        
        <x-slot name="heading">
            {{ $this->getHeading() }}
        </x-slot>

        <div>
            {{ $this->chart }}
        </div>

    </x-filament::section>
</x-filament-widgets::widget>