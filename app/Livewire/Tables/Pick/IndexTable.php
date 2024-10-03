<?php

namespace App\Livewire\Tables\Pick;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\Table;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;
use Permittedleader\Tables\View\Components\Columns\BelongsTo;

class IndexTable extends Table
{
    public bool $isExportable = false;

    public bool $isFilterable = true;

    public function query(): Builder
    {
        return Pick::query();
    }

    public function columns(): array
    {
        return [
            Column::make('id')->sortable(),
            BelongsTo::make('user')->model(User::class)->sortable()->filterable(),
            BelongsTo::make('league')->model(League::class)->sortable()->filterable(),
            BelongsTo::make('season')->model(Season::class)->sortable()->filterable(),
            BelongsTo::make('event')->model(Event::class)->sortable()->filterable(),
            BelongsTo::make('pickable','Pick')->model(Pickable::class)->sortable()->filterable(),
            Column::make('created_at','Pick time')->component('date')
        ];
    }

    public function actions(): array
    {
        return [
            Action::edit('pick.adminEdit')->gate('adminUpdate'),
            Action::delete('pick.destroy')
        ];
    }

    public function tableActions(): array
    {
        return [
            Action::makeLink('pick.adminCreate','Create')->icon('fa-solid fa-pen-to-square')->showLabel()->gate(auth()->user()->can('adminCreate',Pick::class))
        ];
    }
}
