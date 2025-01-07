<?php

namespace App\Livewire\Tables\Pick;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Reactive;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\View\Components\Columns\BelongsTo;

class EventTable extends Table
{
    public bool $isExportable = false;

    public bool $isFilterable = true;

    public int $perPage = 25;

    public League $league;

    #[Reactive]
    public $event_id;

    #[Reactive]
    public $season_id;

    public function query(): Builder
    {
        return Pick::query()->where('league_id',$this->league->id)->where('event_id',$this->event_id)->where('season_id',$this->season_id);
    }

    public function columns(): array
    {
        return [
            BelongsTo::make('user')->model(User::class)->sortable()->filterable(),
            BelongsTo::make('pickable','Pick')->model(Pickable::class)->sortable()->filterable(),
            Column::make('score')->sortable()
        ];
    }

    public function actions(): array
    {
        return [
            
        ];
    }
}
