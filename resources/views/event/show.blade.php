<x-tiffey::layouts.main-layout>
    <livewire:forms.event.event-form method="show" :event="$event" />

    <x-tiffey::card>
        <x-slot:header>Picks</x-slot:header>
        <livewire:tables.pick.index-table :scope="['type'=>'relation','related'=>'event','value'=>$event->id]" />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>