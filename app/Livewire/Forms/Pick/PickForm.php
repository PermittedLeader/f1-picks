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

class PickForm extends Form
{
    public Event $event;
    public Pick $pick;
    public League $league;
    public Season $season;

    public function mount(?Pick $pick)
    {
        $this->label = trans_choice('crud.picks.plural',1);

        if ($pick != '') {
            $this->pick = $pick;
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
        return [
            BelongsTo::make('pickable_id','Your pick...')->options($this->event->availablePicks($this->league, $this->season)),
            Hidden::make('league_id',value: $this->league->id),
            Hidden::make('event_id',value: $this->event->id),
            Hidden::make('season_id',value: $this->season->id)
        ];
    }

    public function actions(): array
    {
        return [
            Action::make('Edit')->visibileOn(['show'])->setShowRoute(function () {
                return route('event.edit', ['event' => $this->event]);
            })->icon('fa-solid fa-pen-to-square'),
        ];
    }
}