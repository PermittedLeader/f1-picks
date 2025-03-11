<?php

namespace App\Livewire\Tables\Events;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\AttachedTable;
use Permittedleader\Tables\View\Components\Columns\Column;

class Seasons extends AttachedTable
{
    public bool $isSearchable = true;

    public string $namespace = __NAMESPACE__;

    public function query(): Builder
    {
        return $this->model->{$this->relationshipName}();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable()->filterable(),
            Column::make('events')->formatDisplay(function($value){
                return $value->count();
            })
        ];
    }
}
