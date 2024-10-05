<div>
    
    <x-tiffey::card>
        <x-slot:header>
            {{ trans_choice('crud.pickables.plural',2) }} {{ __('crud.common.order_for') }} {{ trans_choice('crud.seasons.plural',1) }}: {{ $season->name }}
        </x-slot:header>
        <x-slot:subtitle>
            {{ __('Drag the number to reorder. This page saves automatically.') }}
        </x-slot:subtitle>
        <div class="p-2 [&.draggable-container--is-dragging]:bg-gray-500/10 rounded-xl" wire:sortable.delay="updateOrder">
            @foreach ($season->pickables as $pickable)
            <div wire:sortable.item="{{ $pickable->id }}" >
                <x-tiffey::card >
                    <div class="flex">
                        <div class="my-auto p-2 font-bold cursor-move hover:bg-gray-500/25 rounded-lg" wire:sortable.handle>
                            {{ $pickable->pivot->order }}
                        </div>
                        <div class="ml-4 my-auto">
                            <div class="font-bold">
                                {{ $pickable->name }}
                            </div>
                            <div>
                                {{ $pickable->team }}
                            </div>
                        </div>
                    </div>
                </x-tiffey::card>
            </div>
                
            @endforeach
        </div>
    </x-tiffey::card>
</div>


@push('scripts')
    @once
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
    @endonce
@endpush