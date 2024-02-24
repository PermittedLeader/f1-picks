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

    public string $sortBy = 'pick_date';

    public League $league;

    public function query(): Builder
    {
        return $this->league->events();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable()->filterable(),
            Column::make('season')->formatDisplay(function($value){
                return $value->name;
            }),
            Column::make('date')->component('date')->sortable(),
            Column::make('pick_date','Pick by')->component('timeDiffFOrHumans')->sortable(),
            Column::make('*','Pick')->formatDisplay(function($row){
                return Pick::where('user_id',auth()->id())->where('season_id',$row->season->id)->where('event_id',$row->id)->where('league_id',$this->league->id)->first()?->pickable->name ?? 'No pick entered';
            })
        ];
    }

    public function actions(): array
    {
        return [
            Action::make(function($data){
                return route('pick.edit',['event'=>$data,'league'=>$this->league->id,'season'=>$data->season,'pick'=>1]);
            },"Change Pick...")
                ->icon('fa-solid fa-shuffle')
                ->gate(function($data){
                    return auth()->user()->can('changePick',[$data,$this->league,$data->season]);
                }),
            Action::make(function($data){
                return route('pick.create',['event'=>$data,'league'=>$this->league->id,'season'=>$data->season]);
            },"Pick...")
                ->icon('fa-solid fa-arrows-to-dot')
                ->gate(
                    function($data){
                        return auth()->user()->can('makePick',[$data,$this->league,$data->season]);
                    }
                )
        ];
    }
}
