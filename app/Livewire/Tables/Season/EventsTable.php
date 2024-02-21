<?php

namespace App\Livewire\Tables\Season;

use App\Models\League;
use App\Models\Season;
use App\Traits\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Actions\Action;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;
use Permittedleader\TablesForLaravel\View\Components\Columns\BelongsToMany;

class EventsTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public Season $season;

    public function query(): Builder
    {
        return $this->season->events();
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
