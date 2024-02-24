<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            Pickables
        </x-slot:header>
        @can('create',App\Models\Pickable::class)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('pickable.create') }}" color="bg-secondary-mid">
                    Create
                </x-tiffey::button>
            </x-slot:actions>
            
        @endcan
        <livewire:tables.pickable.index-table />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>