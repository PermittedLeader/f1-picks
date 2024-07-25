<div>
    <div>
        <x-tiffey::input.select label="Event" wire:model.live="season_id">
            @foreach ($league->seasons as $season)
                <option value="{{ $season->id }}">
                    {{ $season->name }}
                </option>
            @endforeach
        </x-tiffey::select>
        <x-tiffey::input.select label="Event" wire:model.live="event_id">
            @foreach ($league->seasons()->where('id',$season_id)->first()->events as $event)
                <option value="{{ $event->id }}">
                    {{ $event->name }}
                </option>
            @endforeach
        </x-tiffey::select>
    </div>
    <div>
        <livewire:tables.pick.event-not-picked-table :$league :$event_id :$season_id />
    </div>
</div>
