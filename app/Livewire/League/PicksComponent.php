<?php

namespace App\Livewire\League;

use App\Models\Event;
use App\Models\League;
use Illuminate\Support\Carbon;
use Livewire\Component;

class PicksComponent extends Component
{

    public $event_id;

    public League $league;

    public function mount()
    {
        $this->event_id = $this->league->events()->orderByRaw('ABS(DATEDIFF("'.Carbon::now().'",date)) ASC')->first()?->id;
    }
    
    public function render()
    {
        return view('livewire.league.picks-component');
    }
}
