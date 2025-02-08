<x-tiffey::layouts.main-layout>
    <livewire:forms.season.season-form method="show" :season="$season" />
    <x-tiffey::card>
        <x-slot:header>
            {{ trans_choice('crud.events.plural',2) }}
        </x-slot:header>
        <livewire:tables.season.events-table :season="$season" />
    </x-tiffey::card>
    <x-tiffey::card>
        <x-slot:header>
            {{ trans_choice('crud.pickables.plural',2) }}
        </x-slot:header>
        <livewire:tables.season.pickable-table :$season />
    </x-tiffey::card>
    <x-tiffey::card collapsible="true" open="{{ (int)$season->hasJokers() }}">
        <x-slot:header>
            {{ __('crud.seasons.inputs.jokers') }}
        </x-slot:header>
        <livewire:season.joker-rules :$season lazy />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>