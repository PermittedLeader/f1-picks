<x-tiffey::layouts.main-layout>
    <livewire:forms.league.league-form method="edit" :league="$league" />
    <x-tiffey::card>
        <x-slot:header>Seasons</x-slot:header>
        <livewire:tables.league.seasons-table :league="$league" />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>