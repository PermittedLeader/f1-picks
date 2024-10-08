<?php

namespace App\Livewire\Tables\League;

use App\Models\League;
use App\Traits\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\BelongsToManyTable;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;

class MembersAdminTable extends BelongsToManyTable
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
        ];
    }
}
