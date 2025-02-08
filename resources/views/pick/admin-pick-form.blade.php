<div>
    <x-tiffey::card>
        <x-slot:header>
        Create a pick on behalf of a user
        </x-slot:header>
        <div>
            <x-tiffey::input.select label="User" wire:model.live="selectedUserId">
                <option value="">-</option>
                @foreach ($this->visibleUsers() as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </x-tiffey::input.select>
            @isset($this->selectedUser)
                <x-tiffey::input.select label="League" wire:model.live="selectedLeagueId">
                    <option value="">-</option>
                    @foreach ($this->userLeagues() as $league)
                        <option value="{{ $league->id }}">{{ $league->name }}</option>
                    @endforeach
                </x-tiffey::input.select>
            @endisset
            @isset($this->league)
                <x-tiffey::input.select label="Season" wire:model.live="selectedSeasonId">
                    <option value="">-</option>
                    @foreach ($this->leagueSeasons() as $season)
                        <option value="{{ $season->id }}">{{ $season->name }}</option>
                    @endforeach
                </x-tiffey::input.select>
            @endisset
            @isset($this->season)
                <x-tiffey::input.select label="Event" wire:model.live="selectedEventId">
                    <option value="">-</option>
                    @foreach ($this->seasonEvents() as $event)
                        <option value="{{ $event->id }}">{{ $event->name }}</option>
                    @endforeach
                </x-tiffey::input.select>
            @endisset
            @isset($this->event)
                @if($this->season->hasJokers() && $this->season->userHasJokerPickAvailable($this->selectedUser, $this->league))
                    <x-forms::input.toggle
                        label="Joker?"
                        wire:model.live="isJoker"
                        />
                @endif
                <x-tiffey::input.select label="Pick" wire:model.live="selectedPickableId">
                    <option value="">-</option>
                    @foreach ($this->eventPickables() as $pickable)
                        <option value="{{ $pickable->id }}">{{ $pickable->name }}</option>
                    @endforeach
                </x-tiffey::input.select>
            @endisset
            @if(isset($this->selectedPickableId)&&$this->method == 'create')
                <x-slot:footerActions>
                    <x-tiffey::button wire:click="create" color="bg-brand-mid">
                        Submit
                    </x-tiffey::button>
                </x-slot:footerActions>
            @endif
            @if(isset($this->selectedPickableId)&&$this->method == 'update')
                <x-tiffey::input label="Score" wire:model="score" />
                <x-slot:footerActions>
                    <x-tiffey::button wire:click="update" color="bg-brand-mid">
                        Submit
                    </x-tiffey::button>
                </x-slot:footerActions>
            @endif
        </div>
    </x-tiffey::card>
</div>
