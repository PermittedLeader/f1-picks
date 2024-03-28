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
</x-tiffey::layouts.main-layout>