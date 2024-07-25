<x-tiffey::layouts.main-layout>
    <form action="{{ route('order.update',$season->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <x-tiffey::card>
            <x-slot:header>
                Pickables order for season: {{ $season->name }}
            </x-slot:header>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-0 md:gap-2">
                @foreach ($season->pickables as $pickable)
                    <x-tiffey::card>  
                        <x-slot:header>
                            {{ $pickable->name }}
                        </x-slot:header>
                        <x-slot:subtitle>
                            {{ $pickable->team }}
                        </x-slot:subtitle>
                        <x-tiffey::input
                            label="Order"
                            name="pickable[{{ $pickable->id }}]"
                            value="{{ $pickable->pivot->order }}" />
                    </x-tiffey::card> 
                @endforeach
            </div>
            <x-slot:footerActions>
                <x-tiffey::form-button color="bg-brand-mid">
                    Submit
                </x-tiffey::form-button>
            </x-slot:footerActions>
        </x-tiffey::card>
    </form>
</x-tiffey::layouts.main-layout>