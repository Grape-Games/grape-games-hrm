<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Employee;
use App\Models\EmployeeAdditionalInformation;
use App\Models\EmployeeBankDetails;
use App\Models\EmployeeEmergencyContact;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class EmployeeTable extends DataTableComponent
{
    protected $listeners = ['dt' => '$refresh', 'onDeleteEmployee', 'onUpdateEmployeeStatus'];

    protected $showAllEmployees = false;

    public function onDeleteEmployee(Employee $employee)
    {
        $employee->delete();

        return $this->emit('toast', 'success', "Employee was deleted successfully.", "Account Status");
    }

    public function onUpdateEmployeeStatus(Employee $employee, string $status)
    {
        $employee->setStatus($status);
    }

    public function getCompanies(): array
    {
        return Company::all()
            ->mapWithKeys(function ($company) {
                return [$company->id => $company->name];
            })
            ->toArray();
    }

    public function columns(): array
    {
        return [
            Column::make("Name", "first_name")
                ->searchable()
                ->sortable(),
            Column::make("Email address", "email_address")
                ->searchable()
                ->sortable(),
            Column::make("Primary contact", "primary_contact")
                ->searchable()
                ->sortable(),
            Column::make("Status"),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Action"),
        ];
    }

    public function filters(): array
    {
        return [
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    'yes' => 'Yes',
                    'no' => 'No',
                ]),
            'company' => Filter::make('Company')
                ->select(['' => 'Any', ...$this->getCompanies()]),
        ];
    }

    public function query(): Builder
    {
        return Employee::query()
            ->when($this->getFilter('active'), function ($query, $status) {
                return $status == "yes"
                    ? $query->active()
                    : $query->inActive();
            })
            ->when($this->getFilter('company'), fn ($query, $companyId) => $query->where('company_id', $companyId));
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.employee_table';
    }
}
