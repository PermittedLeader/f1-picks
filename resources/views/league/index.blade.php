<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            Leagues
        </x-slot:header>
        @can('create',App\Models\League::class)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('league.create') }}" color="bg-secondary-mid">
                    Create
                </x-tiffey::button>
            </x-slot:actions>
            
        @endcan
        <livewire:tables.league.index-table />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>