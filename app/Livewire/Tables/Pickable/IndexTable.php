<?php

namespace App\Livewire\Tables\Pickable;

use App\Models\Event;
use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\View\Components\Columns\BelongsToMany;

class IndexTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public function query(): Builder
    {
        return Pickable::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
            Column::make('team')->sortable(),
            Column::make('short_name')->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Action::show('pickable.show'),
            Action::edit('pickable.edit'),
            Action::delete('pickable.destroy'),
        ];
    }
}
