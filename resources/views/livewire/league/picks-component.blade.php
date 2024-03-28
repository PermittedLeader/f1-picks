<div>
    <div>
        <x-tiffey::input.select label="Event" wire:model.live="event_id">
            @foreach ($league->events as $event)
                <option value="{{ $event->id }}">
                    {{ $event->name }}
                </option>
            @endforeach
        </x-tiffey::select>
    </div>
    <div>
        <livewire:tables.pick.event-table :$league :$event_id />
    </div>
</div>
