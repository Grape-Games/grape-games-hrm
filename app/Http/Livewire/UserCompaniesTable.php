<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserCompaniesTable extends DataTableComponent
{

    protected $listeners = ['dt' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Sr.No", "id")
                ->sortable(),
            Column::make("Admin Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Admin Email", "email")
                ->searchable()
                ->sortable(),
            Column::make("Assigned Companies", "assignedCompanies")
                ->sortable(),
            Column::make("Action"),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return User::query()->admins();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.user_companies_table';
    }
}
