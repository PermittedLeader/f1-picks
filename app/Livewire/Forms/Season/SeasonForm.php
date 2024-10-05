<?php
namespace App\Livewire\Forms\Season;

use App\Models\Season;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;
use Permittedleader\Forms\View\Components\Actions\Action;

class SeasonForm extends Form
{
    public Season $season;

    public function mount(?Season $season)
    {
        $this->label = trans_choice('crud.seasons.plural',1);
        
        if ($season != '') {
            $this->season = $season;
        }
        $this->setCreateRoute(function () {
            return route('season.store');
        });
        $this->setEditRoute(function () {
            return route('season.update', ['season'=>$this->season]);
        });
    }
    public function fields(): array
    {
        return [
            Text::make('name', __('crud.seasons.inputs.name'),value: $this->season->name),
        ];
    }

    public function actions(): array
    {
        return [
            Action::make('Edit')->visibileOn(['show'])->setShowRoute(function () {
                return route('season.edit', ['season' => $this->season]);
            })->icon('fa-solid fa-pen-to-square'),
        ];
    }
}