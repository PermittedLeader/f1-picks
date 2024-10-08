<?php

namespace App\Livewire\Tables\Season;

use App\Models\League;
use App\Models\Season;
use App\Traits\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\View\Components\Columns\BelongsToMany;

class IndexTable extends Table
{
    public bool $isSearchable = true;

    public bool $isExportable = true;

    public bool $isFilterable = true;

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

    public function actions(): array
    {
        return [
            Action::show('season.show'),
            Action::edit('season.edit'),
            Action::delete('season.destroy'),
        ];
    }
}
