<?php
namespace App\Livewire\Tables\League;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\Http\Livewire\BelongsToManyTable;

class MembersAttachTable extends BelongsToManyTable
{
    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('name','crud.users.inputs.name'),
            Column::make('email','crud.users.inputs.email')
        ];
    }
}