<div>
    <x-tiffey::modal wire:model="eventListModal">
        <livewire:tables.event.attach-table :model="$season" relationshipName="events" />
    </x-tiffey::modal>
</div>