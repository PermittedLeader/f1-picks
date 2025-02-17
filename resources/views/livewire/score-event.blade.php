<div>
    <x-tiffey::card>
        <x-slot:header>Score Event</x-slot:header>
        <x-slot:subtitle>
        You are scoring <strong>{{ $this->event->name }}</strong> for <strong>{{ $season->name }}</strong> season as part of <strong>{{ $league->name }}</strong> league.</x-slot:subtitle>
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead class="border-l-4 border-l-transparent">
                    <th class="text-sm p-2 text-left border-b-4">{{ __('crud.pickables.inputs.name') }}</th>
                    <th class="text-sm p-2 text-left border-b-4">{{ __('crud.picks.inputs.score') }}</th>
                    @if($season->hasJokers())
                    <th class="text-sm p-2 text-left border-b-4">{{ __('crud.picks.inputs.score_with_joker') }}</th>
                    @endif
                </thead>
                <tbody>
                    @forelse ($this->pickables as $pickable)
                        <tr class="border-b border-l-4 border-l-transparent hover:border-l-brand-mid hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="p-2 md:p-3">{{ $pickable->name }}</td>
                            <td class="p-2 md:p-3">
                                <x-tiffey::input label="Score" name="score_{{ $pickable->id }}" wire:model="scores.{{ $pickable->id }}" inBlock="true" type="number"  />
                            </td>
                            @if($season->hasJokers())
                            <td class="p-2 md:p-3">
                                <x-tiffey::input label="Score" name="joker_score_{{ $pickable->id }}" wire:model="jokerScores.{{ $pickable->id }}" inBlock="true" type="number"   />
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr class="border-b border-l-4 border-l-transparent hover:border-l-brand-mid hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="p-2 md:p-3" colspan="{{ $season->hasJokers() ? '3' : '2' }}">
                                No scorable items for this event.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <x-slot:footerActions>
            <x-tiffey::button wire:click="submitScores">Submit</x-tiffey::button>
        </x-slot:footerActions>
    </x-tiffey::card>
</div>
