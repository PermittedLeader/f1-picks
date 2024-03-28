<?php

namespace App\Livewire\Tables\League;

use App\Models\League;
use App\Traits\FlashMessages;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\TablesForLaravel\Http\Livewire\Table;
use Permittedleader\TablesForLaravel\View\Components\Actions\Action;
use Permittedleader\TablesForLaravel\View\Components\Columns\Column;

class AdminsTable extends Table
{
    public bool $isSearchable = false;

    public bool $isExportable = false;

    public bool $isFilterable = false;

    public League $league;

    public bool $adminsListModal = false;

    public string $exportName = 'users-export';

    public function query(): Builder
    {
        return $this->league->admins();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
        ];
    }

    public function actions(): array
    {
        return [];
    }

    public function tableActions(): array
    {
        return [
            Action::makeClick('$wire.adminsListModal = true', 'Attach')->showLabel()->icon('fa-solid fa-link')
        ];
    }

    public function modals(): array
    {
        return [
            view('league.admins-list-modal', ['league' => $this->league]),
        ];
    }
}
