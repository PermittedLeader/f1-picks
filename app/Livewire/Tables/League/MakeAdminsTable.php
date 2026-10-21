<?php

namespace App\Livewire\Tables\League;

use App\Models\League;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Permittedleader\FlashMessages\FlashMessages;
use Permittedleader\Tables\Http\Livewire\BelongsToManyTable;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;

class MakeAdminsTable extends BelongsToManyTable
{
    public function query(): Relation
    {
        return $this->model->members();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
            Column::make('email')->sortable(),
        ];
    }

    public function actions(): array
    {
        return [
            Action::makeAction(function($data){
                return 'makeAdmin('.$data->id.')';
            },'Promote to admin')->icon('fa-solid fa-user-plus')
        ];
    }

    public function makeAdmin($userId)
    {
        DB::table($this->model->admins()->getTable())
            ->insert([
                "adminable_type" => $this->model::class,
                "adminable_id" => $this->model->id,
                "user_id" => $userId
            ]);

        $user = User::find($userId);

        $this->success('User '.$user->name.' has been made a league admin');

        $this->dispatch('refreshParent');
    }
}
