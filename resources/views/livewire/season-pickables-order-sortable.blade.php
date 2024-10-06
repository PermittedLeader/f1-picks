<div>
    @if(Session::has('messages'))
        @foreach (Session::pull('messages') as $message)
            <x-tiffey::alert level="{{ $message['level'] }}" dismissable="{{ $message['dismissable'] }}">
                @if ($message['title'])
                    <x-slot name="header">
                        {{ $message['title'] }}
                    </x-slot>
                @endif
                @if ($message['actions'])
                    <x-slot name="actions">
                        {{ $message['actions'] }}
                    </x-slot>
                @endif
                {{ $message['message'] }}
            </x-tiffey::alert>
        @endforeach
    @endif
    <x-tiffey::card>
        <x-slot:header>
            {{ trans_choice('crud.pickables.plural',2) }} {{ __('crud.common.order_for') }} {{ trans_choice('crud.seasons.plural',1) }}: {{ $season->name }}
        </x-slot:header>
        <x-slot:subtitle>
            {{ __('Drag the number to reorder.') }}
            {{ __('Items at the bottom will be auto-picked first. Items at the top are the most valuable picks') }}
        </x-slot:subtitle>
        <div class="p-2 [&.draggable-container--is-dragging]:bg-gray-500/10 rounded-xl" wire:sortable="updateOrder">
            @foreach ($this->orderedItems as $key=>$orderItem)
                @php
                    $pickable = $season->pickables->where('id',$orderItem['value'])->first();
                @endphp
                <div wire:sortable.item="{{ $pickable->id }}" >
                    <x-tiffey::card >
                        <div class="flex">
                            <div class="my-auto p-2 font-bold cursor-move hover:bg-gray-500/25 rounded-lg" wire:sortable.handle>
                                {{ $key+1 }}
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
            <x-slot:footerActions>
                <x-tiffey::button wire:click="saveUpdatedOrder" color="bg-brand-mid" wire:loading.class="data-loading">
                    {{ __('crud.common.save') }}
                </x-tiffey::button>
            </x-slot:footerActions>
        </div>
    </x-tiffey::card>
</div>


@push('scripts')
    @once
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
    @endonce
@endpush