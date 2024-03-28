<div>
    <x-tiffey::modal wire:model="adminsListModal">
        <x-slot name="header" >
            Attach Admin
        </x-slot>
        <livewire:tables.league.make-admins-table :league="$league" lazy />
    </x-tiffey::modal>
</div>