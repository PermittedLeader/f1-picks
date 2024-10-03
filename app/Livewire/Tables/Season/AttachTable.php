<?php

namespace App\Livewire\Tables\Season;

use App\Models\Season;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\BelongsToManyTable;
use Permittedleader\Tables\View\Components\Columns\Column;

class AttachTable extends BelongsToManyTable
{
    public function query(): Builder
    {
        return Season::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
        ];
    }
}
