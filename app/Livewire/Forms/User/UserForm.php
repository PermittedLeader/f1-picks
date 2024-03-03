<?php
namespace App\Livewire\Forms\User;

use App\Models\User;
use Permittedleader\Forms\Http\Livewire\Form;
use Permittedleader\Forms\View\Components\Fields\Text;
use Permittedleader\Forms\View\Components\Actions\Action;

class UserForm extends Form
{
    public User $user;

    public function mount(?User $user)
    {
        if ($user != '') {
            $this->user = $user;
        }
        $this->setCreateRoute(function () {
            return route('user.store');
        });
        $this->setEditRoute(function () {
            return route('user.update', ['user'=>$this->user]);
        });
    }
    public function fields(): array
    {
        return [
            Text::make('name',value: $this->user->name),
            Text::make('email', value: $this->user->email)
        ];
    }

    public function actions(): array
    {
        return [
            Action::make('Edit')->visibileOn(['show'])->setShowRoute(function () {
                return route('user.edit', ['user' => $this->user]);
            })->icon('fa-solid fa-pen-to-square'),
        ];
    }
}