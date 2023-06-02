<?php

namespace App\View\Components\Admin\Dashboard;

use App\Models\AssignedCompany;
use App\Models\Employee;
use App\Models\EmployeeLeaves;
use App\Models\SalaryFormula;
use App\Models\Evalutation;
use App\Traits\RestrictTrait;
use Illuminate\View\Component;

class TablesComponent extends Component
{
    use RestrictTrait;
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
        $employees = Employee::latest()->limit(10)->with(['company','user'])->get();

        $employeeLeaves = EmployeeLeaves::latest()->limit(5)->with(['owner','approvedBy'])->get();

        $salaries = SalaryFormula::orderBy('basic_salary', 'desc')->limit(5)->get();
        
        $evalution = Evalutation::whereMonth('from_date',date('m'))->with('employee')
        ->latest()->limit(10)->get();
        return view('components.admin.dashboard.tables-component', [   
            'employees' => $employees,
            'employeeLeaves' => $employeeLeaves,
            'salaries' => $salaries,
            'evalutions' => $evalution,
        ]);
    }
}
