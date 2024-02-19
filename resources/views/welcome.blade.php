<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot name="header">
                {{ __('Dashboard') }}
        </x-slot>
        {{ __("You're logged in!") }} Card....
    </x-tiffey::card>
    
    <x-tiffey::card collapsible="true">
        <x-slot name="header">
                {{ __('Dashboard') }}
        </x-slot>
        <x-slot name="subtitle">
                Welcome
        </x-slot>
        <x-slot name="actions">
            <x-tiffey::button>Action</x-tiffey::button>
    </x-slot>
        {{ __("You're logged in!") }} Card....
    </x-tiffey::card>

    <x-tiffey::card collapsible="true">
        <x-slot name="header">
                {{ __('Dashboard') }}
        </x-slot>
        <x-slot name="footerActions">
            <x-tiffey::button>Action</x-tiffey::button>
    </x-slot>
        {{ __("You're logged in!") }} Card....
        <span class="text-white"></span>
    </x-tiffey::card>

    <x-tiffey::card collapsible="true" open="false">
        <x-slot name="header">
                {{ __('Dashboard') }}
        </x-slot>
        <x-slot name="footerActions">
            <x-tiffey::button>Action</x-tiffey::button>
    </x-slot>
        <x-tiffey::card collapsible="true" open="false">
            <x-slot name="header">
                    {{ __('Dashboard') }}
            </x-slot>
            <x-slot name="footerActions">
                <x-tiffey::button>Action</x-tiffey::button>
        </x-slot>
            <x-tiffey::card collapsible="true" open="false">
                <x-slot name="header">
                        {{ __('Dashboard') }}
                </x-slot>
                <x-slot name="footerActions">
                    <x-tiffey::button>Action</x-tiffey::button>
            </x-slot>
                {{ __("You're logged in!") }} Card....
                <span class="text-white"></span>
            </x-tiffey::card>
        </x-tiffey::card>
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>
