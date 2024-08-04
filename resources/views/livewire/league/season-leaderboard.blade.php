<div>
    <div>
        <x-tiffey::input.select label="Season" wire:model.live="season_id">
            @foreach ($league->seasons as $season)
                <option value="{{ $season->id }}">
                    {{ $season->name }}
                </option>
            @endforeach
        </x-tiffey::select>
    </div>
    <div>
        <livewire:tables.league.members-table :$league season_id="{{ $season_id }}" lazy />
    </div>
</div>
