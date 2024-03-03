<?php

namespace App\Livewire\Tables\League;

use App\Models\League;
use App\Traits\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;

class MembersTable extends Table
{
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
            Column::make('*', 'Score')->formatDisplay(function($value){
                return $value->picks->pluck('score')->sum();
            })
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
