<x-tiffey::layouts.main-layout>
    <livewire:forms.season.season-form method="show" :season="$season" />
    <x-tiffey::card>
        <x-slot:header>
            Events
        </x-slot:header>
        <livewire:tables.season.events-table :season="$season" />
    </x-tiffey::card>
    <x-tiffey::card>
        <x-slot:header>
            Pickables
        </x-slot:header>
        <livewire:tables.season.pickable-table :$season />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>