<?php

namespace App\Livewire\Tables\League;

use App\Models\Pick;
use App\Models\League;
use App\Models\Season;
use App\Traits\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Actions\Action;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;
use Permittedleader\TablesForLaravel\View\Components\Columns\BelongsToMany;

class SeasonsTable extends Table
{
    public bool $isSearchable = true;

    public bool $isExportable = false;

    public bool $isFilterable = true;

    public bool $seasonListModal = false;

    public League $league;

    public function query(): Builder
    {
        return $this->league->seasons();
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

    public function actions(): array
    {
        return [
            Action::show('season.show'),
            Action::edit('season.edit'),
        ];
    }

    public function tableActions(): array
    {
        return [
            Action::makeAction('showSeasonListModal()', 'Attach')
        ];
    }

    public function modals(): array
    {
        return [
            view('league.season-list-modal', ['league' => $this->league]),
        ];
    }

    public function showSeasonListModal()
    {
        $this->seasonListModal = true;
    }
}
