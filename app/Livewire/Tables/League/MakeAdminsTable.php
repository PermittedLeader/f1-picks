<?php

namespace App\Livewire\Tables\League;

use App\Models\User;
use App\Models\League;
use Illuminate\Support\Facades\DB;
use Permittedleader\FlashMessages\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Actions\Action;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;

class MakeAdminsTable extends Table
{
    use FlashMessages;
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public League $league;

    public string $exportName = 'users-export';

    public function query(): Builder
    {
        return $this->league->members();
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
        DB::table($this->league->admins()->getTable())
            ->insert([
                "adminable_type" => $this->league::class,
                "adminable_id" => $this->league->id,
                "user_id" => $userId
            ]);

        $user = User::find($userId);

        self::success('User '.$user->name.' has been made a league admin');

        $this->dispatch('refreshParent');
    }
}
