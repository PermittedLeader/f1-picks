<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            {{ $league->name }}
        </x-slot:header>
        @can('update',$league)
            <x-slot:actions>
                <x-tiffey::button href="{{ route('league.edit',$league) }}" color="bg-secondary-mid">
                    Edit
                </x-tiffey::button>
            </x-slot:actions>
        @endcan
        <div class="prose dark:prose-invert max-w-none">
            
            {!! Str::markdown($league->description ?? '') !!}
        </div>
        
    </x-tiffey::card>

    <x-tiffey::card collapsible="true">
        <x-slot:header><x-tiffey::icon icon="fa-solid fa-ranking-star" label="league table" /> League Table</x-slot:header>
        <x-league-leaderboard :league="$league" />
        <x-tiffey::card collapsible="true" open="false">
            <x-slot:header>Full table</x-slot:header>
            <livewire:tables.league.members-table :league="$league" lazy />
        </x-tiffey::card>
    </x-tiffey::card>

    <x-tiffey::card collapsible="true" open="false">
        <x-slot:header>Picks...</x-slot:header>
        <livewire:league.picks-component :league="$league" lazy />
    </x-tiffey::card>

    <x-tiffey::card>
        <x-slot:header>Events</x-slot:header>
        <livewire:tables.league.events-table :league="$league" />
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>