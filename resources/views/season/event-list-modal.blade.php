<div>
    <x-tiffey::card-modal wire:model="eventListModal">
        <x-slot name="header" >
            Attach Events
        </x-slot>
        <livewire:tables.event.attach-table :model="$season" relationshipName="events" />
    </x-tiffey::card-modal>
</div>