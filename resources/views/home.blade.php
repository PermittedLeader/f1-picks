<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot name="header">
                {{ __('Dashboard') }}
        </x-slot>
        {{ __('app.you_are_logged_in') }}
    </x-tiffey::card>
    
    <x-tiffey::card>
        <x-slot:header>
                {{ trans_choice('crud.leagues.plural',2) }}
        </x-slot>
        <div class="flex flex-col md:grid md:grid-cols-3 md:gap-2">
            @foreach ($leagues as $league)
                <x-tiffey::card>
                    <x-slot:header>
                        <a href="{{ route('league.show',$league) }}">{{ $league->name }} <x-tiffey::icon icon="fa-solid fa-chevron-right" label="{{ __('app.go_to') }} {{ trans_choice('crud.leagues.plural',1) }}" /></a>
                    </x-slot:header>
                    <x-slot:actions>
                        <div class="ml-2">
                            <x-tiffey::icon icon="fa-solid fa-people-group" label="# {{ trans_choice('crud.users.plural',2) }}" /> {{ $league->members->count(); }}
                        </div>
                        
                    </x-slot:actions>
                    
                </x-tiffey::card>
            @endforeach
        </div>
    </x-tiffey::card>

    <x-tiffey::card>
        <x-slot:header>
                {{ __('app.available_leagues',['leagues'=>trans_choice('crud.leagues.plural',2)]) }}
        </x-slot>
        <x-slot:subtitle>
            @foreach ($availableLeagues as $league)
                <x-tiffey::card>
                    <x-slot:header>
                        {{ $league->name }}
                    </x-slot:header>
                    <x-slot:actions>
                        <div class="ml-2">
                            <x-tiffey::icon icon="fa-solid fa-people-group" label="# {{ trans_choice('crud.users.plural',2) }}" /> {{ $league->members->count(); }}
                        </div>
                        
                    </x-slot:actions>
                    {!! Str::markdown($league->description ?? '') !!}
                    <x-slot:footerActions>
                        <x-tiffey::button color="bg-brand-mid" href="{{ route('league.join',$league) }}">
                            {{ __('app.join') }}
                        </x-tiffey::button>
                    </x-slot:footerActions>
                    
                </x-tiffey::card>
            @endforeach
        </x-slot>
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>
