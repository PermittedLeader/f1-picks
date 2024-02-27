<?php

namespace App\Livewire\Tables\Pick;

use App\Models\Pick;
use App\Models\User;
use App\Models\Event;
use App\Models\League;
use App\Models\Season;
use App\Models\Pickable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;
use Permittedleader\TablesForLaravel\View\Components\Columns\BelongsTo;

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
            BelongsTo::make('pickable')->model(Pickable::class)->sortable()->filterable(),
            Column::make('created_at','Pick time')->component('date')
        ];
    }

    public function actions(): array
    {
        return [
            
        ];
    }
}
