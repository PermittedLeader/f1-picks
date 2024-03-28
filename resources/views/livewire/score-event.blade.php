<div>
    <x-tiffey::card>
        <x-slot:header>Score Event</x-slot:header>
        <x-slot:subtitle>
        You are scoring <strong>{{ $this->event->name }}</strong> for <strong>{{ $season->name }}</strong> season as part of <strong>{{ $league->name }}</strong> league.</x-slot:subtitle>
        <div class="grid grid-cols-3 gap-2">
            @forelse($season->pickables as $pickable)
                <x-tiffey::card>
                    <x-slot:header>{{ $pickable->name }}</x-slot:header>
                    <x-slot:subtitle>{{ $pickable->team }}</x-slot:subtitle>
                    <x-tiffey::input label="Score" name="score_{{ $pickable->id }}" wire:model="scores.{{ $pickable->id }}" />
                </x-tiffey::card>
            @empty
                <x-tiffey::card>
                    No scorable items for this event.
                </x-tiffey::card>
            @endforelse
        </div>
        <x-slot:footerActions>
            <x-tiffey::button wire:click="submitScores">Submit</x-tiffey::button>
        </x-slot:footerActions>
    </x-tiffey::card>
</div>
