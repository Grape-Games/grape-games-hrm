<?php

namespace App\View\Components;

use App\Models\Employee;
use App\Models\SalarySlip;
use Carbon\Carbon;
use Illuminate\View\Component;
use App\Models\EmployeeSalarySlip;

class EmployeePrintSalarySlip extends Component
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
        // $slip = SalarySlip::where('employee_id', $employeeId)->where('month_year', Carbon::now()->format('Y-M'))->first();
        $slip = EmployeeSalarySlip::where([
            'employee_id' => $employeeId, 'dated' => Carbon::now()->format('Y-m')
        ])
            ->first();
            
        return view('components.employee-print-salary-slip', [
            'slip' => $slip,
            'slipRoute' => !empty($slip) ? route('dashboard.print-slip', [$slip->id]) : ''
        ]);
    }
}
