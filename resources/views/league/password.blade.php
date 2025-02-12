<x-tiffey::layouts.main-layout>
    <x-tiffey::card>
        <x-slot:header>
            {{ $league->name }}
        </x-slot:header>
        <x-tiffey::card>
        <div class="prose dark:prose-invert max-w-none">
            
            {!! Str::markdown($league->description ?? '') !!}
        </div>
        </x-tiffey::card>
        <form action="{{ route('league.password',$league) }}" method="post">
            @csrf
            <x-tiffey::input
                type="password"
                label="{{ __('crud.leagues.inputs.password') }}"
                name="password"
                />
            <x-tiffey::form-button>{{ __('app.join') }}</x-tiffey::form-button>
        </form>
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>