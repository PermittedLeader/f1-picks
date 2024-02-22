<?php

namespace App\Livewire\Tables\Event;

use App\Models\Event;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Actions\Action;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;
use Permittedleader\TablesForLaravel\View\Components\Columns\BelongsToMany;

class IndexTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public function query(): Builder
    {
        return Event::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Action::show('event.show'),
            Action::edit('event.edit'),
            Action::delete('event.destroy'),
        ];
    }
}
