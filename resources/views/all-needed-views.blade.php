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

    <x-tiffey::alert level="success">
        ALERT!
    </x-tiffey::alert>
    <x-tiffey::alert level="warning">
        ALERT!
    </x-tiffey::alert>
    <x-tiffey::alert level="danger">
        ALERT!
    </x-tiffey::alert>
    <x-tiffey::alert level="info">
        ALERT!
    </x-tiffey::alert>
    <x-tiffey::card-modal>
    </x-tiffey::card-modal>
    <x-tiffey::nav.link>Nav link</x-tiffey::nav.link>
    <x-tiffey::nav.dropdown>Nav dropdown</x-tiffey::nav.dropdown>
</x-tiffey::layouts.main-layout>
