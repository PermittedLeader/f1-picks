<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot name="header">
                {{ __('Welcome to') }} {{ config('app.name') }}
        </x-slot>
        The home of F1 (picking)!
    </x-tiffey::card>
    <x-tiffey::card>
        Register above to access the picking leagues available to you!
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>
