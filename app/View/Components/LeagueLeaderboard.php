<?php

namespace App\View\Components;

use Closure;
use App\Models\Pick;
use App\Models\League;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class LeagueLeaderboard extends Component
{


    public array $top3places = [];

    public int $userRank;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public League $league
    )
    {
        $results = Pick::query()
        ->with("user")
        ->select("user_id")
        ->selectRaw(DB::raw("SUM('score') as 'totalScore'"))
        ->selectRaw(DB::raw("DENSE_RANK() OVER (ORDER BY SUM('score')) as \"rank\""))
        ->where("league_id", $this->league->id)
        ->groupBy("user_id")
        ->get()
        ->sortByDesc('rank');

        $this->top3places[1] = $results->where('rank','=',1);
        $this->top3places[2] = $results->where('rank','=',2);
        $this->top3places[3] = $results->where('rank','=',3);

        $this->userRank = $results->where('user_id',auth()->id())->first()?->rank ?? 0;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.league-leaderboard');
    }
}
