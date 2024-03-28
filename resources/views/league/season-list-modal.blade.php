<div>
    <x-tiffey::modal wire:model="seasonListModal">
        <x-slot name="header" >
            Attach Season
        </x-slot>
        <livewire:tables.season.attach-table :model="$league" relationshipName="seasons" />
    </x-tiffey::modal>
</div>