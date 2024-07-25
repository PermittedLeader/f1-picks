<?php

namespace App\Livewire\Tables\Season;

use App\Models\Event;
use App\Models\Season;
use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Actions\Action;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;
use Permittedleader\TablesForLaravel\View\Components\Columns\BelongsToMany;

class PickableTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public Season $season;

    public bool $pickableListModal = false;

    public function query(): Builder
    {
        return $this->season->pickables()->withPivot(['order']);
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
            Column::make('team')->sortable(),
            Column::make('*','Order')->formatDisplay(fn($value)=>$value->pivot->order)->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            
        ];
    }

    public function tableActions(): array
    {
        return [
        ];
    }

    public function modals(): array
    {
        return [
            view('season.pickable-list-modal', ['season' => $this->season]),
        ];
    }

    public function showPickableListModal()
    {
        $this->pickableListModal = true;
    }
}
