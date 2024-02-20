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
            {!! Str::markdown($league->description) !!}
        </div>
        
    </x-tiffey::card>
</x-tiffey::layouts.main-layout>