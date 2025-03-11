<x-tiffey::layouts.main-layout>
    <livewire:forms.event.event-form method="edit" :event="$event" />

    <div x-data="{ showModal: false }">
        <x-tiffey::card>
            <x-slot:header>
                Seasons
            </x-slot:header>
            <x-slot:actions>
                <x-tiffey::button @click="showModal = true">
                    {{ __('tables::tables.relationships.attach')}}
                </x-tiffey::button>
            </x-slot:actions>
            <livewire:tables.events.seasons lazy relationshipName="seasons" :model="$event"/>
        </x-tiffey::card>
        <x-tiffey::modal x-model="showModal">
            <livewire:tables.season.attach-table :model="$event" relationshipName="seasons" />
        </x-tiffey::modal>
    </div>
</x-tiffey::layouts.main-layout>