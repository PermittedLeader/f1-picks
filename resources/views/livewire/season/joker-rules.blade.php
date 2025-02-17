<div>
    <x-flash-messages::flash-messages />
    <x-forms::input
        type="number"
        label="{{ __('crud.seasons.inputs.joker_pick_count') }}"
        min="0"
        step="1"
        wire:model="pick_count"
        />

    @foreach ($this->joker_restrictions as $key =>$restriction)
        @php
            $key = \App\Enums\JokerRestrictionType::from($key);
        @endphp
        <div wire:key="{{ $key }}">
            <x-tiffey::card >
            <x-slot:header>{{ $key->display() }}</x-slot:header>
            @if($key->restrictionType() == 'boolean')
                <x-forms::input.toggle
                    label="{{ $key->display() }}"
                    wire:model.live="joker_restrictions.{{ $key->value }}"
                    />
            @elseif($key->restrictionType() == 'pickable')
            <x-slot:header>{{ $key->display() }}</x-slot:header>
            <livewire:tables.season.joker-pickable-table :$season :selectedIds="$restriction" :key="$key->value" restriction="{{ $key->value }}"/>
            @endif
            <x-slot:actions><x-tiffey::button-no-link wire:click="remove('{{ $key->value }}')" >
            {{ __('crud.common.remove') }}
        </x-tiffey::button-no-link></x-slot:actions>
        </x-tiffey::card>
        </div>
        
    @endforeach

    <x-tiffey::card collapsible="true" open="false">
        <x-slot:header>{{ __('crud.common.create') }} {{ __('crud.seasons.jokers.restrictions') }}</x-slot:header>
        <x-forms::input.select
                label="{{ __('crud.seasons.jokers.restrictions') }}"
                wire:model="addNewRestrictionType"
                >
                <option value="">Select...</option>
                @foreach(\App\Enums\JokerRestrictionType::cases() as $restriction_type)
                <option 
                    value="{{ $restriction_type->value }}" 
                >
                    {{ $restriction_type->display() }}
                </option>
                @endforeach
        </x-forms::input.select>
        <x-slot:actions><x-tiffey::button-no-link wire:click="addNew" >
            {{ __('crud.common.create') }}
        </x-tiffey::button-no-link></x-slot:actions>
    </x-tiffey::card>

    <x-tiffey::button-no-link wire:click="save" >
        {{ __('crud.common.save') }}
    </x-tiffey::button-no-link>
</div>
