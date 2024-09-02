<?php

namespace App\Livewire\Tables\League;

use App\Models\League;
use App\Traits\FlashMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;

class MembersTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public int $perPage = 25;

    public int $topNRemaining = 5;

    public string $sortBy = 'rank';

    public League $league;

    #[Reactive]
    public $season_id;

    public string $exportName = 'users-export';

    public function query(): Builder
    {
        return $this->league->members()
        ->join("picks", "users.id", "=", "picks.user_id")
        ->where("picks.league_id", $this->league->id)
        ->when($this->season_id,function($query){
            $query->where('picks.season_id',$this->season_id);
            $query->selectRaw("(
            SELECT
                SUBSTRING_INDEX(GROUP_CONCAT(short_name ORDER BY ps.`order` SEPARATOR ', ') ,', ','".$this->topNRemaining."')
            FROM
                pickables p
            JOIN pickable_season ps on
                p.id = ps.pickable_id
            WHERE
                ps.season_id = '".$this->season_id."'
                AND p.id NOT IN (
                SELECT
                    pickable_id
                from
                    picks p2
                JOIN events e on
                    e.id = p2.event_id    
                where
                    league_id = '".$this->league->id."'
                    AND e.pick_date < NOW()
                    AND season_id = '".$this->season_id."'
                    AND user_id = users.id)
            ORDER BY
                ps.`order` ASC
                ) AS 'remainingTopPicks'");
        })
        ->selectRaw("sum(`picks`.`score`) AS 'score'")
        ->selectRaw(
            DB::raw("DENSE_RANK() OVER (ORDER BY sum(`picks`.`score`) DESC) as \"rank\"")
          )
        ->groupBy("picks.user_id")
        ->groupBy("league_members.league_id");
    }

    public function columns(): array
    {
        $columns =  [
            Column::make('rank')->sortable(),
            Column::make('name')->sortable(),
            Column::make('score', 'Score')->sortable()
        ];
        if($this->season_id){
            $columns[] = Column::make('remainingTopPicks','Best '.$this->topNRemaining.' picks remaining');
        }
        return $columns;
    }

    public function actions(): array
    {
        return [];
    }
}
