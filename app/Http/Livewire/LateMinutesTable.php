<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\LateMinutes;

class LateMinutesTable extends DataTableComponent
{

    protected $listeners = ['dt' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Sr.No", "id")
                ->searchable()
                ->sortable(),
            Column::make("Month", "month")
                ->searchable()
                ->sortable(),
            Column::make("Minutes", "minutes")
                ->searchable()
                ->sortable(),
            Column::make("Date", "date")
                ->searchable()
                ->sortable(),
            Column::make("Type", "type")
                ->searchable()
                ->sortable(),
            Column::make("Employee Name", "employee.first_name")
                ->searchable()
                ->sortable(),
            Column::make("Company Name", "employee.company.name")
                ->searchable()
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
        return LateMinutes::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.late_minutes_table';
    }
}
