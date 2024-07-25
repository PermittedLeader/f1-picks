<?php

namespace App\Livewire\League;

use App\Models\Event;
use App\Models\League;
use Illuminate\Support\Carbon;
use Livewire\Component;

class NotPickedComponent extends Component
{

    public $event_id;

    public $season_id;

    public League $league;

    public function mount()
    {
        $this->season_id = $this->league->seasons->first()->id;
        $this->event_id = $this->league->events()->orderByRaw('ABS(DATEDIFF("'.Carbon::now().'",date)) ASC')->first()?->id;
    }
    
    public function render()
    {
        return view('livewire.league.not-picked-component');
    }
}
