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
    <div x-data="{ showModal: false }">
        <x-tiffey::card>
            <x-slot:header>
                Admins
            </x-slot:header>
            <x-slot:actions>
                <x-tiffey::button @click="showModal = true">
                    {{ __('crud.common.attach')}}
                </x-tiffey::button>
            </x-slot:actions>
            <livewire:tables.league.admins-table :model="$league" relationshipName="admins" lazy />
        </x-tiffey::card>
        <x-tiffey::modal x-model="showModal">
            <livewire:tables.league.make-admins-table :model="$league" relationshipName="admins" lazy />
        </x-tiffey::modal>
    </div>
    @if($league->seasons->count() > 0)
    <x-tiffey::card>
        <x-slot:header>Missing picks</x-slot:header>
        <livewire:league.not-picked-component :league="$league" lazy />
    </x-tiffey::card>
    @endif
</x-tiffey::layouts.main-layout>