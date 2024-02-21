<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            Seasons
        </x-slot:header>
        @can('create',App\Models\Season::class)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('season.create') }}" color="bg-secondary-mid">
                    Create
                </x-tiffey::button>
            </x-slot:actions>
            <livewire:tables.season.index-table />
        @endcan
        
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>