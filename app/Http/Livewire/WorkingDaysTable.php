<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WorkingDay;

class WorkingDaysTable extends DataTableComponent
{

    protected $listeners = ['dt' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Reason", "reason")
                ->sortable(),
            Column::make("Date", "date")
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
        return WorkingDay::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.working_days_table';
    }
}
