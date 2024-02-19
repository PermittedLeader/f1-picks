<?php
namespace App\Forms\Pickable;

use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;

class PickableForm extends Form
{
    public function fields(): array
    {
        return [
            Text::make('name'),
            Text::make('team')
        ];
    }
}