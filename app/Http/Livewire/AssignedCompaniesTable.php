<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\AssignedCompany;

class AssignedCompaniesTable extends DataTableComponent
{

    protected $listeners = ['dt' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Sr.No", "id")
                ->sortable(),
            Column::make("Admin Name", "user.name")
                ->searchable()
                ->sortable(),
            Column::make("Admin Email", "user.email")
                ->searchable()
                ->sortable(),
            Column::make("Assigned Companies", "user.assignedCompanies")
                ->sortable(),
            Column::make("Added By", "addedBy.name")
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
        return AssignedCompany::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.assigned_companies_table';
    }
}
