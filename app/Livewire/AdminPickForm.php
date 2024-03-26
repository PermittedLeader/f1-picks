<?php

namespace App\Livewire;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Permittedleader\FlashMessages\FlashMessages;

class AdminPickForm extends Component
{
    use FlashMessages;
    public $selectedUserId;
    public $selectedLeagueId;
    public $selectedSeasonId;
    public $selectedEventId;
    public $selectedPickableId;

    public $method;

    public Pick $pick;

    public $score;

    public function mount(?Pick $pick = null)
    {
        if(!is_null($pick)){
            $this->selectedUserId = $pick->user_id;
            $this->selectedLeagueId = $pick->league_id;
            $this->selectedSeasonId = $pick->season_id;
            $this->selectedEventId = $pick->event_id;
            $this->selectedPickableId = $pick->pickable_id;
            $this->score = $pick->score;
            $this->method = 'update';
        } else {
            $this->method = 'create';
        }
    }

    public function visibleUsers()
    {
        return User::all();
    }

    #[Computed]
    public function selectedUser()
    {
        return User::find($this->selectedUserId);
    }

    #[Computed]
    public function league()
    {
        return League::find($this->selectedLeagueId);
    }

    #[Computed]
    public function season()
    {
        return Season::find($this->selectedSeasonId);
    }

    #[Computed]
    public function event()
    {
        return Event::find($this->selectedEventId);
    }

    public function userLeagues()
    {
        return $this->selectedUser->leagues;
    }

    public function leagueSeasons()
    {
        return $this->league->seasons;
    }

    public function seasonEvents() 
    {
        if($this->method == "create"){
            return $this->season->eventsWithoutPicksForUser($this->selectedUser,$this->league);
        } else {
            return $this->season->events;
        }
        
    }

    public function eventPickables()
    {
        return $this->event->availablePicks($this->league,$this->season,$this->selectedUser);
    }

    public function create()
    {
        $this->authorize('adminCreate',Pick::class);

        Pick::create([
            'user_id'=>$this->selectedUserId,
            'league_id'=>$this->selectedLeagueId,
            'season_id'=>$this->selectedSeasonId,
            'event_id'=>$this->selectedEventId,
            'pickable_id'=>$this->selectedPickableId
        ]);

        self::success(title: 'Success',message:'Pick created.');

        redirect('/pick');
    }

    public function update()
    {
        $this->authorize('adminUpdate',$this->pick);

        $this->pick->update([
            'user_id'=>$this->selectedUserId,
            'league_id'=>$this->selectedLeagueId,
            'season_id'=>$this->selectedSeasonId,
            'event_id'=>$this->selectedEventId,
            'pickable_id'=>$this->selectedPickableId,
            'score'=>$this->score
        ]);

        self::success(title: 'Success',message:'Pick updated.');

        redirect('/pick');
    }

    public function render()
    {
        return view('pick.admin-pick-form');
    }
}
