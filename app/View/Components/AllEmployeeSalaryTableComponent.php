<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\SalarySlip;
use Carbon\Carbon;
use Illuminate\View\Component;

class AllEmployeeSalaryTableComponent extends Component
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
        $salArr = [];
        $employees = Employee::active()
            ->all();

        $slips = SalarySlip::where('month_year', Carbon::now()->format('Y-M'))->get();
        foreach ($slips as $slip) {
            if ($employees->contains('id', $slip->employee_id)) {
                $salArr[$slip->employee_id] = $slip;
            }
        }
        return view('components.all-employee-salary-table-component', [
            'employees' => $employees,
            'salArr' => $salArr,
            'month' => Carbon::now()->format('Y-M'),
        ]);
    }
}
