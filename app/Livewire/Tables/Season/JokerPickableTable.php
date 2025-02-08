<?php

namespace App\Livewire\Tables\Season;

use App\Models\Event;
use App\Models\Season;
use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Modelable;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\View\Components\Columns\BelongsToMany;

class JokerPickableTable extends Table
{
    public bool $isSearchable = false;

    public bool $selectable = true;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public array $selectedIds;

    public string $restriction;

    public Season $season;

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
            Action::makeAction('update()','Update')->showLabel()->icon('fa-solid fa-refresh')
        ];
    }

    public function update()
    {
        $this->dispatch('updatedPickables',$this->restriction,$this->selectedIds);
    }
}
