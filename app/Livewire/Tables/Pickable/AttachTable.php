<?php

namespace App\Livewire\Tables\Pickable;

use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\BelongsToManyTable;
use Permittedleader\Tables\View\Components\Columns\Column;

class AttachTable extends BelongsToManyTable
{
    public function query(): Builder
    {
        return Pickable::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
            Column::make('team')->sortable(),
        ];
    }
}
