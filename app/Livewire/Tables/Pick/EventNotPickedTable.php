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
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;
use Permittedleader\TablesForLaravel\View\Components\Columns\BelongsTo;

class EventNotPickedTable extends Table
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
        return User::whereHas("leagues", function ($query) {
                $query->where("id", $this->league->id);
            })
            ->whereNotIn(
                "id",
                Pick::where("league_id", $this->league->id)
                    ->where("event_id", $this->event_id)
                    ->where("season_id", $this->season_id)
                    ->select("user_id")
            );
    }

    public function columns(): array
    {
        return [
            Column::make('name')
        ];
    }

    public function actions(): array
    {
        return [
            
        ];
    }
}
