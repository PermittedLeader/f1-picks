<?php

namespace App\Livewire\Tables\League;

use App\Models\League;
use App\Traits\FlashMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;

class MembersTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public int $perPage = 25;

    public string $sortBy = 'rank';

    public League $league;

    public string $exportName = 'users-export';

    public function query(): Builder
    {
        return $this->league->members()
        ->join("picks", "users.id", "=", "picks.user_id")
        ->where("picks.league_id", $this->league->id)
        ->selectRaw("sum(`picks`.`score`) AS 'score'")
        ->selectRaw(
            DB::raw("DENSE_RANK() OVER (ORDER BY sum(`picks`.`score`) DESC) as \"rank\"")
          )
        ->groupBy("picks.user_id")
        ->groupBy("league_members.league_id");
    }

    public function columns(): array
    {
        return [
            Column::make('rank')->sortable(),
            Column::make('name')->sortable(),
            Column::make('score', 'Score')->sortable()
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
