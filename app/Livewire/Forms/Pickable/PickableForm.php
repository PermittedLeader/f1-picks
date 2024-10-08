<?php
namespace App\Livewire\Forms\Pickable;

use App\Models\Pickable;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;
use Permittedleader\Forms\View\Components\Actions\Action;

class PickableForm extends Form
{
    public Pickable $pickable;

    public function mount(?Pickable $pickable)
    {
        $this->label = trans_choice('crud.pickables.plural',1);

        if ($pickable != '') {
            $this->pickable = $pickable;
        }
        $this->setCreateRoute(function () {
            return route('pickable.store');
        });
        $this->setEditRoute(function () {
            return route('pickable.update', ['pickable'=>$this->pickable]);
        });
    }
    public function fields(): array
    {
        return [
            Text::make('name',value: $this->pickable->name),
            Text::make('team',value: $this->pickable->team),
            Text::make('short_name',value: $this->pickable->short_name)
        ];
    }

    public function actions(): array
    {
        return [
            Action::make('Edit')->visibileOn(['show'])->setShowRoute(function () {
                return route('pickable.edit', ['pickable' => $this->pickable]);
            })->icon('fa-solid fa-pen-to-square'),
        ];
    }
}