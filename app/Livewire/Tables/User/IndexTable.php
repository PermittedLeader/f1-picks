<?php

namespace App\Livewire\Tables\User;


use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;

class IndexTable extends Table
{
    public bool $isExportable = false;

    public bool $isFilterable = true;

    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id')->sortable(),
            Column::make('name')->sortable(),
            Column::make('email')->sortable(),
            Column::make('updated_at','Last Updated')->sortable()
        ];
    }

    public function actions(): array
    {
        return [
            Action::show('user.show'),
            Action::edit('user.update')->gate(function(){
                return auth()->user()->can('edit users');
            }),
            Action::delete('user.destroy'),
        ];
    }
}
