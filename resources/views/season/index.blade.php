<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            {{ trans_choice('crud.seasons.plural',2) }}
        </x-slot:header>
        @can('create',App\Models\Season::class)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('season.create') }}" color="bg-secondary-mid">
                    {{ __('crud.common.create') }}
                </x-tiffey::button>
            </x-slot:actions>
        @endcan
        <livewire:tables.season.index-table />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>