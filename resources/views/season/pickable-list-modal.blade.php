<div>
    <x-tiffey::card-modal wire:model="pickableListModal">
        <x-slot name="header" >
            Attach Pickables
        </x-slot>
        <livewire:tables.pickable.attach-table :model="$season" relationshipName="pickables" />
    </x-tiffey::card-modal>
</div>