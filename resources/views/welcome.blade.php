<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot name="header">
                {{ __('app.welcome',['app_name'=>config('app.name')]) }}
        </x-slot>
        {{ __('app.welcome_text') }}
    </x-tiffey::card>
    <x-tiffey::card>
        {{ __('app.please_register') }}
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>
