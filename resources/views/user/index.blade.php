<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            Users
        </x-slot:header>
        @can('create',App\Models\User::class)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('user.create') }}" color="bg-secondary-mid">
                    Create
                </x-tiffey::button>
            </x-slot:actions>
        @endcan
        <livewire:tables.user.index-table />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>