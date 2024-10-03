<?php

namespace App\Livewire\Tables\League;

use App\Models\User;
use App\Models\League;
use App\Traits\FlashMessages;
use Permittedleader\Tables\Http\Livewire\Table;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Permittedleader\Tables\Http\Livewire\AttachedTable;
use Permittedleader\Tables\View\Components\Actions\Action;
use Permittedleader\Tables\View\Components\Columns\Column;

class AdminsTable extends AttachedTable
{
    public bool $adminsListModal = false;

    public function query(): Builder
    {
        return $this->model->admins();
    }

    public function columns(): array
    {
        return [
            Column::make('name')->sortable(),
        ];
    }
}
