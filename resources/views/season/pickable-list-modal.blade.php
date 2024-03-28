<div>
    <x-tiffey::modal wire:model="pickableListModal">
        <livewire:tables.pickable.attach-table :model="$season" relationshipName="pickables" />
    </x-tiffey::modal>
</div>