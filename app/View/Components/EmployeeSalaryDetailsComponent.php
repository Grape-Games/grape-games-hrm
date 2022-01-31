<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\SalaryFormula;
use Illuminate\View\Component;

class EmployeeSalaryDetailsComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $employeeId = Employee::where('user_id', auth()->id())->value('id');
        return view('components.employee-salary-details-component',[
            'formula' => SalaryFormula::where('employee_id', $employeeId)->first()
        ]);
    }
}
