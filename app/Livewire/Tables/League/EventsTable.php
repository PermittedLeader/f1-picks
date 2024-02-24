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

class EventsTable extends Table
{
    public bool $isSearchable = true;

    public bool $isExportable = false;

    public bool $isFilterable = true;

    public League $league;

    public function query(): Builder
    {
        return $this->league->events();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable()->filterable(),
            BelongsToMany::make('seasons')->model(Season::class)->filterable(),
            Column::make('date')->component('date')->sortable(),
            Column::make('pick_date','Pick by')->component('timeDiffFOrHumans')->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Action::make('event.show',"Change Pick...")
                ->icon('fa-solid fa-shuffle')
                ->gate(function($data){
                    return auth()->user()->can('changePick',[$data,$this->league,$data->seasons->first()]);
                }),
            Action::make(function($data){
                return route('pick.create',['event'=>$data,'league'=>$this->league->id,'season'=>$data->seasons->first()]);
            },"Pick...")
                ->icon('fa-solid fa-arrows-to-dot')
                ->gate(
                    function($data){
                        return auth()->user()->can('makePick',[$data,$this->league,$data->seasons->first()]);
                    }
                )
        ];
    }
}
