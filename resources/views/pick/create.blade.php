<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>Choose your pick...</x-slot:header>
        Choose your pick for the <strong>{{ $event->name }}</strong>, part of the season <strong>{{ $season->name }}</strong>, for league: <strong>{{ $league->name }}</strong>.
    </x-tiffey::card>
    <livewire:forms.pick.pick-form method="create" :league="$league" :event="$event" :$season />
</x-tiffey::layouts.main-layout>