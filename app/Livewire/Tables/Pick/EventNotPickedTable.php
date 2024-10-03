<?php

namespace App\Livewire\Tables\Pick;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use App\Models\Pickable;
use Carbon\Carbon;
use Livewire\Attributes\Reactive;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\View\Components\Columns\BelongsTo;

class EventNotPickedTable extends Table
{
    public bool $isExportable = false;

    public bool $isFilterable = true;

    public bool $selectable = true;

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
            )
            ->select(['users.id','users.name'])
            ->selectRaw("
                (SELECT name FROM pickables p 
                JOIN pickable_season ps on p.id = ps.pickable_id
                WHERE
                    ps.season_id = '".$this->season_id."'
                    AND p.id NOT IN (
                        SELECT
                            pickable_id
                        from
                            picks p2 
                        where
                            league_id = '".$this->league->id."'
                            AND season_id = '".$this->season_id."'
                            AND user_id = users.id
                            AND deleted_at IS NULL
                    )
                ORDER BY ps.order DESC
                LIMIT 1) as nextAutoPick");
    }

    public function columns(): array
    {
        return [
            Column::make('name'),
            Column::make('nextAutoPick')
        ];
    }

    public function actions(): array
    {
        if($this->event->pick_date < Carbon::now()){
            return [
                Action::makeAction(function ($rowData){
                    return 'autopick('.$rowData->id.')';
                }, __('Autopick'))->icon('fa-solid fa-wand-magic-sparkles')
            ];
        } else {
            return [];
        }
    }

    public function bulkActions(): array
    {
        if($this->event->pick_date < Carbon::now()){
            return [
                Action::makeAction('autopickSelected',__('Autopick'))->icon('fa-solid fa-wand-magic-sparkles')->showLabel()
            ];
        } else {
            return [];
        }
        
    }

    #[Computed]
    public function event(): Event
    {
        return Event::find($this->event_id);
    }

    public function autopick(array|int $ids){
        $this->authorize('create',[Pick::class, Event::find($this->event->id), $this->league, Season::find($this->season_id)]);
        $ids = collect($ids);
        $users = User::whereIn('id',$ids)->select('id')->selectRaw("
        (SELECT id FROM pickables p 
        JOIN pickable_season ps on p.id = ps.pickable_id
        WHERE
            ps.season_id = '".$this->season_id."'
            AND p.id NOT IN (
                SELECT
                    pickable_id
                from
                    picks p2 
                where
                    league_id = '".$this->league->id."'
                    AND season_id = '".$this->season_id."'
                    AND user_id = users.id
            )
        ORDER BY ps.order DESC
        LIMIT 1) as nextAutoPick")->get();

        foreach ($users as $user){
            Pick::create([
                'user_id'=>$user->id,
                'event_id'=>$this->event_id,
                'league_id'=>$this->league->id,
                'season_id'=>$this->season_id,
                'pickable_id'=>$user->nextAutoPick
            ]);
        }

        self::success(__('Autopicks created'));
    }

    public function autopickSelected(){
        $this->autopick($this->selectedIds);
    }
}
