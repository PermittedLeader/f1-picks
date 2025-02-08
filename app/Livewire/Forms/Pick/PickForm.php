<?php
namespace App\Livewire\Forms\Pick;

use App\Models\Pick;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;
use Permittedleader\Forms\View\Components\Fields\Hidden;
use Permittedleader\Forms\View\Components\Actions\Action;
use Permittedleader\Forms\View\Components\Fields\BelongsTo;
use Permittedleader\Forms\View\Components\Fields\Boolean;

use function PHPUnit\Framework\isNull;

class PickForm extends Form
{
    public Event $event;
    public Pick $pick;
    public League $league;
    public Season $season;
    public bool $isJoker = false;

    public function boot(?Pick $pick = null)
    {
        $this->label = trans_choice('crud.picks.plural',1);
        
        if (!is_null($pick)) {
            $this->pick = $pick;
            $this->isJoker = $this->pick->joker ?? false;
        }
        $this->setCreateRoute(function () {
            return route('pick.store',['event'=>$this->event,'league'=>$this->league,'season'=>$this->season]);
        });
        $this->setEditRoute(function () {
            return route('pick.update', ['event'=>$this->event,'league'=>$this->league,'pick'=>$this->pick,'season'=>$this->season]);
        });
    }
    public function fields(): array
    {
        $fields = [];
        if($this->season->hasJokers() && $this->season->userHasJokerPickAvailable(auth()->user(),$this->league)){
            $fields = [
                Boolean::make('joker',__('crud.picks.inputs.joker'))->customAttributes(['wire:model.live'=>'isJoker']),
            ];
        }
        $fields = array_merge($fields,[
            
            BelongsTo::make('pickable_id',__('crud.picks.inputs.pickable'))->options($this->event->availablePicks($this->league, $this->season, joker: $this->isJoker)),
            Hidden::make('league_id',value: $this->league->id),
            Hidden::make('event_id',value: $this->event->id),
            Hidden::make('season_id',value: $this->season->id)
        ]);
        return $fields;
    }

    public function actions(): array
    {
        return [
            
        ];
    }
}