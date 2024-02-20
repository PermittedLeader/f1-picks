<?php
namespace App\Livewire\Forms\Season;

use App\Models\Season;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;

class SeasonForm extends Form
{
    public Season $season;

    public function mount(?Season $season)
    {
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
            Text::make('name',value: $this->season->name),
        ];
    }
}