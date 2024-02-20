<?php
namespace App\Livewire\Forms\Pickable;

use App\Models\Pickable;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;

class PickableForm extends Form
{
    public Pickable $pickable;

    public function mount(?Pickable $pickable)
    {
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
            Text::make('team',value: $this->pickable->team)
        ];
    }
}