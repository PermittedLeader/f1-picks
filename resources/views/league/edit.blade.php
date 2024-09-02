<x-tiffey::layouts.main-layout>
    <livewire:forms.league.league-form method="edit" :league="$league" />
    <x-tiffey::card>
        <x-slot:header>Seasons</x-slot:header>
        <livewire:tables.league.seasons-table :league="$league" />
    </x-tiffey::card>
    <x-tiffey::card>
        <x-slot:header>Members</x-slot:header>
        <livewire:tables.league.members-admin-table :league="$league" lazy relationshipName="members" :model="$league"/>
    </x-tiffey::card>
    <x-tiffey::card>
        <x-slot:header>Admins</x-slot:header>
        <livewire:tables.league.admins-table :league="$league" lazy />
    </x-tiffey::card>
    @if($league->seasons->count() > 0)
    <x-tiffey::card>
        <x-slot:header>Missing picks</x-slot:header>
        <livewire:league.not-picked-component :league="$league" lazy />
    </x-tiffey::card>
    @endif
</x-tiffey::layouts.main-layout>