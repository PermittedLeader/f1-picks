<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            Events
        </x-slot:header>
        @can('create',App\Models\Event::class)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('event.create') }}" color="bg-secondary-mid">
                    Create
                </x-tiffey::button>
            </x-slot:actions>
            
        @endcan
        <livewire:tables.event.index-table />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>