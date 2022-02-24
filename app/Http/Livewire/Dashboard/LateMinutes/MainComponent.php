<?php

namespace App\Http\Livewire\Dashboard\LateMinutes;

use App\Models\Company;
use App\Models\Employee;
use Livewire\Component;

class MainComponent extends Component
{
    public $employees, $companies, $employee_id, $company_id;

    public function __construct()
    {
        $this->employees = Employee::all();
        $this->companies = Company::all();
    }

    public function rules()
    {
        return [
            'employee_id' => 'exists:employees,id|nullable',
            'company_id' => 'exists:employees,id|nullable',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function render()
    {
        return view('livewire.dashboard.late-minutes.main-component');
    }
}
