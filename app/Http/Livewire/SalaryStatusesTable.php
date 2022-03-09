<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\EmployeeSalaryStatus;
use App\Traits\ToastTrait;

class SalaryStatusesTable extends DataTableComponent
{
    use ToastTrait;

    protected $listeners = ['dt' => '$refresh', 'changeVal'];

    public $view;

    public function changeVal($id, $value)
    {
        EmployeeSalaryStatus::find($id)->update(['can_view' => $value])
        ? $this->getSuccess("Employee dashboard updated. ✔️")
        : $this->getError("Employee dashboard was not updated. ❌");
    }

    public function columns(): array
    {
        return [
            Column::make("Sr.No", "id")
                ->sortable(),
            Column::make("Can Employee See", "can_view"),
            Column::make("Increment Period", "time_period")
                ->searchable()
                ->sortable(),
            Column::make("Last increment Date", "last_increment")
                ->searchable()
                ->sortable(),
            Column::make("Last increment Amount", "last_increment_amount")
                ->searchable()
                ->sortable(),
            Column::make("Next increment", "next_increment")
                ->searchable()
                ->sortable(),
            Column::make("Next Increment amount", "increment_amount")
                ->sortable(),
            Column::make("Salary Before Increment", "before_increment")
                ->searchable()
                ->sortable(),
            Column::make("Salary After Increment")
                ->sortable(),
            Column::make("Employee Name", "employee.first_name")
                ->searchable()
                ->sortable(),
            Column::make("Company Name", "employee.company.name")
                ->searchable()
                ->sortable(),
            Column::make("Added By", "user.name")
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
        return EmployeeSalaryStatus::query()->latest()->distinct('employee_id');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.salary_statuses_table';
    }
}
