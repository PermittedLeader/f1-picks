<?php
namespace App\Livewire\Forms\Event;

use App\Models\Event;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;
use Permittedleader\Forms\View\Components\Actions\Action;

class EventForm extends Form
{
    public Event $event;

    public function mount(?Event $event)
    {
        if ($event != '') {
            $this->event = $event;
        }
        $this->setCreateRoute(function () {
            return route('event.store');
        });
        $this->setEditRoute(function () {
            return route('event.update', ['event'=>$this->event]);
        });
    }
    public function fields(): array
    {
        return [
            Text::make('name',value: $this->event->name),
            Text::make('team',value: $this->event->team)
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