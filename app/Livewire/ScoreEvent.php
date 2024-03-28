<?php

namespace App\Livewire;

use App\Models\Pick;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use Livewire\Component;
use Permittedleader\FlashMessages\FlashMessages;

class ScoreEvent extends Component
{
    use FlashMessages;

    public Event $event;
    public Season $season;
    public League $league;

    public array $scores;
    
    public function render()
    {
        return view('livewire.score-event');
    }

    public function submitScores()
    {
        foreach($this->scores as $pickable => $score){
            Pick::where('event_id',$this->event->id)
                ->where('season_id',$this->season->id)
                ->where('league_id',$this->league->id)
                ->where('pickable_id',$pickable)
                ->update(['score'=>$score]);
        }
        
        self::success('You have submitted scores for this event');

        return redirect(route('league.show',$this->league));
    }
}
