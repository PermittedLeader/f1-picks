<?php
namespace App\Livewire\Forms\League;

use App\Models\League;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;
use Permittedleader\Forms\View\Components\Actions\Action;
use Permittedleader\Forms\View\Components\Fields\Boolean;
use Permittedleader\Forms\View\Components\Fields\Markdown;

class LeagueForm extends Form
{
    public League $league;

    public function mount(?League $league)
    {
        if ($league != '') {
            $this->league = $league;
        }
        $this->setCreateRoute(function () {
            return route('league.store');
        });
        $this->setEditRoute(function () {
            return route('league.update', ['league'=>$this->league]);
        });
    }
    public function fields(): array
    {
        return [
            Text::make('name',__('crud.leagues.inputs.name'),value: $this->league->name)->required(),
            Markdown::make('description',__('crud.leagues.inputs.description'), value: $this->league->description),
            Boolean::make('public',__('crud.leagues.inputs.public'),$this->league->public),
            Text::make('slug',__('crud.leagues.inputs.slug'),$this->league->slug),
            Text::make('password',__('crud.leagues.inputs.password'),$this->league->password)->visibileOn(['show'])
        ];
    }

    public function actions(): array
    {
        return [
            Action::make('Edit')->visibileOn(['show'])->setShowRoute(function () {
                return route('league.edit', ['league' => $this->league]);
            })->icon('fa-solid fa-pen-to-square')->gate(auth()->user()->can('update',$this->league)),
        ];
    }
}