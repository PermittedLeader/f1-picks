<?php

namespace App\Livewire\Tables\Event;

use App\Models\Event;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\BelongsToManyTable;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;

class AttachTable extends BelongsToManyTable
{
    public function query(): Builder
    {
        return Event::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
            Column::make('date')->component('date')
        ];
    }
}
