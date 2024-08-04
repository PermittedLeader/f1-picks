<?php

namespace App\Livewire\League;

use App\Models\Event;
use App\Models\League;
use Illuminate\Support\Carbon;
use Livewire\Component;

class SeasonLeaderboard extends Component
{

    public $event_id;

    public $season_id;

    public League $league;

    public function mount()
    {
        $this->season_id = $this->league->seasons->first()->id;
    }
    
    public function render()
    {
        return view('livewire.league.season-leaderboard');
    }
}
