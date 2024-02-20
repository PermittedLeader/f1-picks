<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot name="header">
                {{ __('Dashboard') }}
        </x-slot>
        {{ __("You're logged in!") }}
    </x-tiffey::card>
    
    <x-tiffey::card>
        <x-slot:header>
                {{ __('Your Leagues') }}
        </x-slot>
        <div class="flex flex-col md:grid md:grid-cols-3 md:gap-2">
            @foreach ($leagues as $league)
                <x-tiffey::card>
                    <x-slot:header>
                        <a href="{{ route('league.show',$league) }}">{{ $league->name }} <x-tiffey::icon icon="fa-solid fa-chevron-right" label="Go to league" /></a>
                    </x-slot:header>
                    <x-slot:actions>
                        <div class="ml-2">
                            <x-tiffey::icon icon="fa-solid fa-people-group" label=" Number of Members" /> {{ $league->members->count(); }}
                        </div>
                        
                    </x-slot:actions>
                    Current position: 
                </x-tiffey::card>
            @endforeach
        </div>
    </x-tiffey::card>

    <x-tiffey::card>
        <x-slot:header>
                {{ __('Available Leagues') }}
        </x-slot>
        <x-slot:subtitle>
            @foreach ($availableLeagues as $league)
                <x-tiffey::card>
                    <x-slot:header>
                        {{ $league->name }}
                    </x-slot:header>
                    <x-slot:actions>
                        <div class="ml-2">
                            <x-tiffey::icon icon="fa-solid fa-people-group" label=" Number of Members" /> {{ $league->members->count(); }}
                        </div>
                        
                    </x-slot:actions>
                    {!! Str::markdown($league->description) !!}
                    <x-slot:footerActions>
                        <x-tiffey::button color="bg-brand-mid" href="{{ route('league.join',$league) }}">
                            Join
                        </x-tiffey::button>
                    </x-slot:footerActions>
                    
                </x-tiffey::card>
            @endforeach
        </x-slot>
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>
