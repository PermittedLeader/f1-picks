<?php

namespace App\Livewire\Tables\League;

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
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public function query(): Builder
    {
        return League::query();
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
            Action::show('league.show'),
            Action::edit('league.edit'),
            Action::delete('league.destroy'),
        ];
    }
}
